<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\UniversityCreateRequest;
use App\Http\Requests\Api\Property\UniversityUpdateRequest;
use App\Models\Property;
use App\Models\University;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UniversityController extends Controller
{
    /**
     * Retrieve all universities with optional search and pagination.
     * @param Request $request
     */
    public function index(Request $request)
    {
        try {
            $search     = $request->query('search');
            $perPage    = $request->query('per_page', 25);
            $propertyId = $request->query('property_id');
            $userId     = Auth::id();

            $query = University::with(['properties:id,title'])->where('user_id', $userId)->orderByDesc('id');
            if (! empty($propertyId)) {
                $query->whereHas('properties', function ($q) use ($propertyId) {
                    $q->where('properties.id', $propertyId);
                });
            }
            //Filter
            if (! empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('distance', 'like', '%' . $search . '%')
                        ->orWhere('walk_time', 'like', '%' . $search . '%')
                        ->orWhere('cycle_time', 'like', '%' . $search . '%')
                        ->orWhere('drive_time', 'like', '%' . $search . '%');
                });
            }
            $universities = $query->paginate($perPage);
            return Helper::jsonResponse(true, 'Universities retrieved successfully.', 200, $universities, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Create a new university.
     * Scoped to user's properties
     * UniversityCreateRequest will validate the request
     */
    public function store(UniversityCreateRequest $request)
    {
        $validated  = $request->validated();
        $propertyId = $validated['property_id'];
        unset($validated['property_id']);

        //Verify property
        $property = Property::where('user_id', Auth::id())->find($propertyId);
        if (! $property) {
            return Helper::jsonResponse(false, 'Property not found', 404);
        }

        DB::beginTransaction();
        try {
            $validated['user_id'] = Auth::id() ?? null;
            $university           = University::create($validated);
            $property->universities()->attach($university->id);
            $university->load('properties:id,title');

            DB::commit();
            return Helper::jsonResponse(true, 'University created successfully.', 201, $university);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'University creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve specific university.
     * Scoped to user's properties
     */
    public function show(int $id)
    {
        try {
            $university = University::with(['properties:id,title'])->find($id);
            if (! $university) {
                return Helper::jsonResponse(false, 'University not found.', 404);
            }
            return Helper::jsonResponse(true, 'University retrieved successfully.', 200, $university);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update specific university.
     * @param UniversityUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UniversityUpdateRequest $request, $id)
    {
        $validated  = $request->validated();
        $university = University::find($id);
        if (! $university) {
            return Helper::jsonResponse(false, 'University not found', 404);
        }

        DB::beginTransaction();
        try {
            if (isset($validated['property_id'])) {
                $propertyId = $validated['property_id'];
                $property   = Property::where('user_id', Auth::id())->find($propertyId);
                if (! $property) {
                    return Helper::jsonResponse(false, 'Property not found or unauthorized', 404);
                }
                $university->properties()->sync([$propertyId]);
                unset($validated['property_id']);
            }

            $university->update($validated);
            $university->load('properties:id,title');
            DB::commit();
            return Helper::jsonResponse(true, 'University updated successfully.', 200, $university);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'University update failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified university.
     * Scoped to user's properties
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $university = University::find($id);
            if (! $university) {
                return Helper::jsonResponse(false, 'University not found.', 404);
            }

            $university->delete();
            DB::commit();
            return Helper::jsonResponse(true, 'University deleted successfully.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'University deletion failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
