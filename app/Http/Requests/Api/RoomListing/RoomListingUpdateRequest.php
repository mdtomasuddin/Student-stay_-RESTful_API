<?php

namespace App\Http\Requests\Api\RoomListing;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoomListingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'property_id'         => 'nullable|exists:properties,id',
            'name'                => 'nullable|string|max:255',
            'description'         => 'nullable|string',
            'room_type'           => 'nullable|array',
            'room_type.*'         => 'integer',
            'images'              => 'array|nullable|max:20',
            'images.*'            => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico,avif,webm|max:204800',
            'amenities'           => 'nullable|array',
            'amenities.*'         => 'integer',
            'contract_type'       => 'nullable|string',
            'move_in_date'        => 'date|nullable',
            'move_out_date'       => 'nullable|date|after_or_equal:move_in_date',
            'tenancy_weeks_min'   => 'nullable|integer|min:0',
            'tenancy_weeks_max'   => 'nullable|integer|min:0|gte:tenancy_weeks_min',
            'price_per_week'      => 'nullable|numeric|min:0',
            'min_price'           => 'nullable|numeric|min:0',
            'max_price'           => 'nullable|numeric|min:0|gte:min_price',
            'is_single_occupancy' => 'nullable|boolean',
            'is_available'        => 'nullable|boolean',
            'is_feature'          => 'nullable|boolean',
            'status'              => 'nullable|string|in:available,occupied,maintenance,reserved',
        ];
    }

    /**
     * Handle a failed validation attempt.
     * @param Validator $validator
     * @throws HttpResponseException
     * @return void First error message is returned
     */
    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();
        throw new HttpResponseException(
            Helper::jsonResponse(false, $message, 422)
        );
    }
}
