<?php
namespace App\Http\Controllers\Api\V1\RoomListing;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RoomListing\RoomListingCreateRequest;
use App\Http\Requests\Api\RoomListing\RoomListingUpdateRequest;
use App\Models\RoomListing;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomListingController extends Controller
{
    /**
     * Retrieve all room listings with optional search and pagination
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $search       = $request->query('search');
            $perPage      = $request->query('per_page', 25);
            $status       = $request->query('status');
            $contractType = $request->query('contract_type');
            $propertyId   = $request->query('property_id');
            $userId       = Auth::id();

            $roomListings = RoomListing::with(['property:id,title'])->where('user_id', $userId);

            if (! empty($propertyId)) {
                $roomListings->where('property_id', $propertyId);
            }

            if (! empty($search)) {
                $roomListings->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('price_per_week', 'like', '%' . $search . '%');
            }
            if (! empty($status)) {
                $roomListings->where('status', $status);
            }
            if (! empty($contractType)) {
                $roomListings->where('contract_type', $contractType);
            }

            $roomListings = $roomListings->paginate($perPage);
            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $roomListings, true);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created room listing in storage.
     * @param \App\Http\Requests\Api\RoomListing\RoomListingCreateRequest $request
     */
    public function store(RoomListingCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            //Handle Images Upload
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $imagePaths[] = Helper::fileUpload($image, 'room_listings', $image->getClientOriginalName());
                }
                $validatedData['images'] = $imagePaths;
            } else {
                $validatedData['images'] = [];
            }

            $validatedData['user_id'] = Auth::id() ?? null;
            $roomListing              = RoomListing::create($validatedData);
            DB::commit();
            return Helper::jsonResponse(true, 'Data created successfully.', 201, $roomListing);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'Data creation failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Retrieve a specific room listing by id.
     * @param int $id RoomListing id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $roomListing = RoomListing::with(['property:id,title'])->where('user_id', Auth::id())->find($id);
            if (! $roomListing) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }

            return Helper::jsonResponse(true, 'Data retrieved successfully.', 200, $roomListing);
        } catch (Exception $e) {
            return Helper::jsonResponse(false, 'Data retrieval failed.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified room listing in storage.
     * @param \App\Http\Requests\Api\RoomListing\RoomListingUpdateRequest $request
     * @param int $id RoomListing id
     */
    public function update(RoomListingUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $roomListing = RoomListing::where('user_id', Auth::id())->find($id);
            if (! $roomListing) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }
            $validated = $request->validated(); //validated data

            //Handling Image Update
            if ($request->hasFile('images')) {
                //old images delete
                if ($roomListing->images && is_array($roomListing->images)) {
                    foreach ($roomListing->images as $oldImage) {
                        $parsedUrl   = parse_url($oldImage, PHP_URL_PATH);
                        $oldFilePath = ltrim($parsedUrl, '/');
                        Helper::fileDelete($oldFilePath);
                    }
                }
                $newImages = []; // Upload new images
                foreach ($request->file('images') as $file) {
                    $newImages[] = Helper::fileUpload($file, 'room_listings', $file->getClientOriginalName());
                }
                $validated['images'] = $newImages;
            }
            $roomListing->update($validated);
            DB::commit();
            return Helper::jsonResponse(true, 'Data updated successfully.', 200, $roomListing->fresh());
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::jsonResponse(false, 'Failed to update data.', 500, [
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified room listing from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $roomListing = RoomListing::where('user_id', Auth::id())->find($id);
            if (! $roomListing) {
                return Helper::jsonResponse(false, 'Data not found.', 404);
            }
            // Delete Images
            if ($roomListing->images && is_array($roomListing->images)) {
                foreach ($roomListing->images as $oldImage) {
                    $parsedUrl   = parse_url($oldImage, PHP_URL_PATH);
                    $oldFilePath = ltrim($parsedUrl, '/');
                    Helper::fileDelete($oldFilePath);
                }
            }
            $roomListing->delete();
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
