<?php

namespace App\Http\Requests\Api\Agent;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a letting agent
     * @return array
     * @throws HttpResponseException Validation Failed
     */
    public function rules(): array
    {
        return [
            'full_name'                => 'required|string|max:255',
            'letting_agent_name'       => 'required|string|max:255',
            'email'                    => 'required|email|max:255|unique:agents,email',
            'phone'                    => [
                'nullable',
                'string',
                'max:20',
                'regex:/^(?:(?:\+44\s?7\d{3})|(?:07\d{3}))\s?\d{3}\s?\d{3}$/',
            ],
            'city_id'                  => 'required|exists:cities,id',
            'source'                   => 'required|string|max:300',
            'properties_managed_count' => 'required|string|max:300',
            'date'                     => 'required|date|after_or_equal:today',
            'time'                     => 'required',
            'notes'                    => 'nullable|string|max:500',
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
