<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\PropertyCreateRequest;
use App\Http\Requests\Api\Property\PropertyUpdateRequest;
use App\Models\Property;
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

            $properties = Property::with(['category:id,name', 'city:id,name'])->where('user_id', $userId)->orderByDesc('id');

            if (! empty($search)) {
                $properties->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
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
     */
    public function store(PropertyCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            //Handle Images Upload
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = Helper::fileUpload($image, 'properties', $image->getClientOriginalName());
                }
                $validatedData['images'] = $imagePaths;
            } else {
                $validatedData['images'] = [];
            }

            $validatedData['user_id'] = Auth::id();
            $property                 = Property::create($validatedData); //create property
            DB::commit();
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
            $properties = Property::with(['category:id,name', 'city:id,name'])->find($id);
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

    /**
     * Update the specified property in storage.
     * @param \App\Http\Requests\Api\Property\PropertyUpdateRequest $request
     * @param int $id Property id
     */
    public function update(PropertyUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $property = Property::where('user_id', Auth::id())->find($id); //find property
            if (! $property) {
                return Helper::jsonResponse(false, 'Property not found.', 404);
            }
            //validated data
            $validated = $request->validated();

            //Handling Image Update
            if ($request->hasFile('images')) {
                //old images delete
                if ($property->images && is_array($property->images)) {
                    foreach ($property->images as $oldImage) {
                        $parsedUrl   = parse_url($oldImage, PHP_URL_PATH);
                        $oldFilePath = ltrim($parsedUrl, '/');
                        Helper::fileDelete($oldFilePath);
                    }
                }
                $NesImages = []; // Upload new images
                foreach ($request->file('images') as $file) {
                    $NesImages[] = Helper::fileUpload($file, 'properties', $file->getClientOriginalName());
                }
                $validated['images'] = $NesImages;
            }
            $property->update($validated);
            DB::commit();
            return Helper::jsonResponse(true, 'Property updated successfully.', 200, $property);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'Failed to update data.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified property from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $property = Property::where('user_id', Auth::id())->find($id);
            if (! $property) {
                return Helper::jsonResponse(false, 'Property not found.', 404);
            }
            // Delete Images
            if ($property->images && is_array($property->images)) {
                foreach ($property->images as $oldImage) {
                    $parsedUrl   = parse_url($oldImage, PHP_URL_PATH);
                    $oldFilePath = ltrim($parsedUrl, '/');
                    Helper::fileDelete($oldFilePath);
                }
            }

            //Delete Universities
            foreach ($property->universities as $university) {
                $university->delete();
            }
            //Delete Roomlists
            foreach ($property->roomListings as $roomListing) {
                $roomListing->delete();
            }
            $property->delete(); //delete property
            DB::commit();
            return Helper::jsonResponse(true, 'Data deleted successfully.', 200);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'Data deletion failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
