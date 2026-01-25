<?php

namespace App\Http\Requests\Api\Property;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PropertyUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            // Property Fields
            'title'                     => 'nullable|string|max:255',
            'category_id'               => 'nullable|exists:categories,id',
            'location'                  => 'nullable|string|max:255',
            'full_address'              => 'nullable|string|max:500',
            'price'                     => 'nullable|numeric|min:1',
            'duration_period'           => 'nullable|string',
            'available_from'            => 'nullable|date',
            'bedrooms'                  => 'nullable|integer|min:1',
            'bathrooms'                 => 'nullable|integer|min:1',
            'description'               => 'nullable|string',
            'amenities'                 => 'nullable|array',
            'bill_included'             => 'nullable|array',
            'images'                    => 'nullable|array',
            'images.*'                  => 'image|mimes:jpg,jpeg,png|max:2048',
            'is_feature'                => 'nullable|boolean',
            'is_available'              => 'nullable|boolean',
            // Universities Fields
            'universities'              => 'nullable|array|min:1',
            'universities.*.name'       => 'nullable|string|max:255',
            'universities.*.distance'   => 'nullable|string',
            'universities.*.walk_time'  => 'nullable|string',
            'universities.*.cycle_time' => 'nullable|string',
            'universities.*.drive_time' => 'nullable|string',
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
