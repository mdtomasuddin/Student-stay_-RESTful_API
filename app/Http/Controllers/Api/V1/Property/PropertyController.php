<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\PropertyCreateRequest;
use App\Models\Property;
use App\Models\University;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Retrieve all  with optional search and pagination
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $search     = $request->query('search');
            $perPage    = $request->query('per_page', 25);
            $status     = $request->query('status');
            $categroyId = $request->query('category_id');
            $Sortby     = $request->query('sort_by');
            $userId     = Auth::id();

            $properties = Property::with(['universities', 'category:id,name'])->where('user_id', $userId);

            if (! empty($search)) {
                $properties->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('university_name', 'like', '%' . $search . '%');
            }
            if (! empty($status)) {
                $properties->where('status', $status);
            }
            if (! empty($categroyId)) {
                $properties->where('category_id', $categroyId);
            }
            if (! empty($Sortby)) {
                $properties->orderBy($Sortby, 'desc');
            }

            $properties = $properties->paginate($perPage);
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $properties, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created property in storage.
     * @param \App\Http\Requests\Api\Property\PropertyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PropertyCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData    = $request->validated();
            $universitiesData = $validatedData['universities']; // Get universities separately
            unset($validatedData['universities']);              // Remove universities from validated data

            //Handle Images Upload
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = Helper::fileUpload($image, 'properties', $image->getClientOriginalName());
                }
                $validatedData['images'] = $imagePaths;
            }

            $validatedData['user_id'] = Auth::id();
            $property                 = Property::create($validatedData); //create property

            //create universities
            $universityIds = [];
            foreach ($universitiesData as $uniData) {
                $university      = University::create($uniData);
                $universityIds[] = $university->id;
            }

            $property->universities()->attach($universityIds); //attach universities to property povit table
            DB::commit();
            $property->load('universities'); //response show universities
            return Helper::jsonResponse(true, 'Property created successfully.', 201, $property);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'Data creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve a specific property by id.
     * @param int $id Property id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $properties = Property::with(['universities', 'category:id,name'])->find($id);
            if (! $properties) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }

            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $properties);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
