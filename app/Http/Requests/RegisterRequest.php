<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            "username"=>["required","between:3,20","unique:users,username"],
            "name"=>["required"],
            "email"=>["required","email","unique:users,email"],
            "password"=>["required",/*"confirmed",*/ Password::min(3)->mixedCase()->numbers()->symbols()],
            /*Role set to "user" in RegisterService*/
        ];
    }

    public function messages(){
        return[
        "username.required"=>"Felhasználónév megadása kötelező",
        "username.between"=>"A karakterek száma nem megfelelő",
        "username.unique"=>"Ez a felhasználónév már létezik",
        "name.required"=>"Név megadása kötelező",
        "email.required"=>"E-mail cím megadása kötelező",
        "email.email"=>"Nem megfelelő az email formátuma",
        "email.unique"=>"Ez az email már használatban van",
        "password.required" => "Jelszó elvárt",
        "password.min" => "Jelszó túl rövid",
        "password.regex" => "Kisbetű, nagybetű, szám kötelező",
        ];
    }

    public function failedValidation( Validator $validator ) {

        throw new HttpResponseException( response()->json([

            "success" => false,
            "message" => "Adatbeviteli hiba",
            "data" => $validator->errors()
        ]));
    }
}
