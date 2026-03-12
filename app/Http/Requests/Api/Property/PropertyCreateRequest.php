<?php
namespace App\Http\Requests\Api\Property;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PropertyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Property Fields
            'title'                           => 'required|string|max:255',
            'category_id'                     => 'required|exists:categories,id',
            'location'                        => 'required|string|max:255',
            'city_id'                         => 'required|exists:cities,id',
            'full_address'                    => 'required|string|max:500',
            'price'                           => 'required|numeric|min:1',
            'duration_period'                 => 'nullable|string',
            'available_from'                  => 'required|date',
            'bedrooms'                        => 'required|integer|min:1',
            'bathrooms'                       => 'required|integer|min:1',
            'description'                     => 'nullable|string',
            'amenities'                       => 'nullable|array',
            'bill_included'                   => 'nullable|array',
            'images'                          => 'nullable|array',
            'images.*'                        => 'image|mimes:jpg,jpeg,png',
            'is_feature'                      => 'nullable|boolean',
            'is_available'                    => 'nullable|boolean',
            'lat'                             => 'nullable|numeric|between:-90,90',
            'lng'                             => 'nullable|numeric|between:-180,180',
            // Universities Fields
            'universities'                    => 'required|array|min:1',
            'universities.*.name'             => 'required|string|max:255',
            'universities.*.distance'         => 'nullable|string',
            'universities.*.walk_time'        => 'nullable|string',
            'universities.*.cycle_time'       => 'nullable|string',
            'universities.*.drive_time'       => 'nullable|string',

            //roomlists Fields
            'roomlists'                       => 'required|array',
            'roomlists.*.name'                => 'nullable|string|max:255',
            'roomlists.*.room_type'           => 'nullable|array',
            'roomlists.*.description'         => 'nullable|string',
            'roomlists.*.images'              => 'nullable|array',
            'roomlists.*.images.*'            => 'image|mimes:jpg,jpeg,png,webp,svg,avif,gif,bmp,ico,png,',
            'roomlists.*.amenities'           => 'nullable|array',
            'roomlists.*.contract_type'       => 'nullable|string',
            'roomlists.*.move_in_date'        => 'nullable|date',
            'roomlists.*.move_out_date'       => 'nullable|date',
            'roomlists.*.tenancy_weeks_min'   => 'nullable|integer',
            'roomlists.*.tenancy_weeks_max'   => 'nullable|integer',
            'roomlists.*.price_per_week'      => 'nullable|numeric',
            'roomlists.*.min_price'           => 'nullable|numeric',
            'roomlists.*.max_price'           => 'nullable|numeric',
            'roomlists.*.is_single_occupancy' => 'nullable|boolean',
            'roomlists.*.is_available'        => 'nullable|boolean',
            'roomlists.*.is_feature'          => 'nullable|boolean',
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
