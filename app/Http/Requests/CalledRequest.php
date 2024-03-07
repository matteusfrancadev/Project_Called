<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Auth;

class CalledRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return true;
    }

    protected function prepareForValidation()
    {
        $uuidUserLogged = Auth::user()->getAuthIdentifier();
        $this->merge([
            'user_uuid' => $uuidUserLogged,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
        'title' => 'required',
        'description' => 'required',
        'establishment_uuid' => 'required|exists:establishments,uuid' ,
        'user_uuid' => 'required|uuid|exists:users,uuid',
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
