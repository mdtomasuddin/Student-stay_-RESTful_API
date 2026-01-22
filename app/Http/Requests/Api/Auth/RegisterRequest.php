<?php

namespace App\Http\Requests\Api\Auth;

use App\Helpers\Helper;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    use ApiResponse;
    private Helper $helper;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'           => 'string|max:255',
            'last_name'            => 'string|max:255',
            'email'                => 'required|string|email|max:255|unique:users,email',
            'phone'                => 'required|string|max:255|unique:users,phone',
            'password'             => 'required|string|min:8|max:300|confirmed',
            'role'                 => 'nullable|in:user,partner,admin',
            'terms_and_conditions' => 'nullable|boolean',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): never
    {
        $errors  = $validator->errors();
        $message = 'Validation failed';

        if ($errors->any()) {
            $message = $errors->first();
        }

        $response = response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
