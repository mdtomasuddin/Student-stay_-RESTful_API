<?php

namespace App\Http\Requests\Api\Property;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UniversityUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'nullable|exists:properties,id',
            'name' => 'sometimes|required|string|max:255',
            'distance' => 'sometimes|required|string|max:255',
            'walk_time' => 'sometimes|required|string|max:255',
            'cycle_time' => 'sometimes|required|string|max:255',
            'drive_time' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|in:active,inactive',
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
