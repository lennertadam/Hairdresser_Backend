<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ServiceRequest extends FormRequest
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
            "service"=>["required","string", "max:255"],
            "required_time"=>["required"], //CANNOT SET IT SO ONLY TIME FORMAT IS ACCEPTED
            "price"=>["required","integer"]
        ];
    }

    public function messages(){
        return[
            "service.required"=>"A mező kitöltése kötelező",
            "service.string"=>"A mezőben csak betűk lehetnek",
            "service.max"=>"A mezőben maximum 255 betű lehet",

            "required_time.required"=>"A mező kitöltése kötelező",
            "required_time.time"=>"A mezőnek idő formátumban kell átadni az adatot",

            "price.required"=>"A mező kitöltése kötelező",
            "price.integer"=>"A mezőnek egész számnak kell lennie"

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
