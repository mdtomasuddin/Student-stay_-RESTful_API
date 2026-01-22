<?php

namespace App\Http\Controllers\Api\V1\Property;

use App\Helpers\Helper;
use App\Http\Controllers\Api\V1\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'partner_id' => Auth::id(),
                'title' => 'required|string|max:255',
                'type' => 'required|in:studio,flat,en_suite,non_en_suite,shared_house,apartment',
                'city' => 'required|strin|max:255',
                'full_address' => 'required|string|max:1000',
                'price_amount' => 'required|numeric|max:100000000000',
                'price_type' => 'required|in:per_week,per_month',
                'available_from' => 'nullable|date|after_or_equal:today',
                'bedroom_count' => 'nullable|integer|max:20',
                'bathroom_count' => 'nullable|integer|max:20',
                'description' => 'nullable|string|max:5000',
                'contact_length' => 'nullable|in:44_week,46_week,48_week,51_week,flexible',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'status' => 'nullable|in:active,reject,pending',
                'images' => 'array|max:5',
                'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
            ]);


            if ($validator->fails()) {
                return $this->error(422, 'validation error', $validator->errors()->first());
            }

            $data = $validator->validated();

            if ($request->hasFile('image')) {
                $data['image'] = Helper::fileUpload($request->file('image'), 'property_images');
            }

            $property = Property::create($data);

            return $this->success(200, 'Property created successfully', $property);
        } catch (\Exception $e) {
            Log::info('PropertyController::store', [
                'error' => $e->getMessage()
            ]);

            return $this->error(500, 'server error', [
                'error' => $e->getMessage()
            ]);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
