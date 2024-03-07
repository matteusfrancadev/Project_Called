<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'cpf' => 'required|unique:users|min:11|max:14',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:100|required_with:confirmed|same:confirmed',
            'confirmed' => 'required|min:8|max:100',
            'type' => 'required',
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "sucess" => false,
            "mensage" => "Validator error",
            "erros" => $validator->errors(),
        ],422));
    }
}
