<?php

namespace App\Http\Requests\Api\RoomListing;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoomListingCreateRequest extends FormRequest
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
            'property_id'         => 'required|exists:properties,id',
            'name'                => 'string|nullable|max:255',
            'description'         => 'string|nullable',
            'room_type'           => 'array|nullable',
            'room_type.*'         => 'integer',
            'images'              => 'array|nullable',
            'images.*'            => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,bmp,tiff,ico,avif|max:30000',
            'amenities'           => 'array|nullable',
            'amenities.*'         => 'integer',
            'contract_type'       => 'string|nullable',
            'move_in_date'        => 'date|nullable',
            'move_out_date'       => 'date|nullable|after_or_equal:move_in_date',
            'tenancy_weeks_min'   => 'integer|nullable|min:0',
            'tenancy_weeks_max'   => 'integer|nullable|min:0',
            'price_per_week'      => 'nullable|numeric|min:0',
            'min_price'           => 'nullable|numeric|min:0',
            'max_price'           => 'nullable|numeric|min:0|gte:min_price',
            'is_single_occupancy' => 'nullable|boolean',
            'is_available'        => 'nullable|boolean',
            'is_feature'          => 'nullable|boolean',
            'status'              => 'string|in:available,occupied,maintenance,reserved',
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
