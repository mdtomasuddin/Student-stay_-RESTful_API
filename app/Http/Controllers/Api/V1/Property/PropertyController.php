<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\PropertyCreateRequest;
use App\Models\Property;
use App\Models\University;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{

    /**
     * Store a newly created property in storage.
     * @param \App\Http\Requests\Api\Property\PropertyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
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
}
