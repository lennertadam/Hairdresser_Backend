<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            "start_time"=>["required","date"], //REQUIRES A TIME IN DATETIME FORMAT
            "end_time"=>["required","date"],
            "price"=>["required","integer"], //EVERY PRICE NEEDS TO HAVE 2 DECIMAL (Example: 4.00,10.33)
            "barber_id"=>["required","integer"],
            "customer_id"=>["required","integer"],
            "active"=>["required","boolean"]
        ];
    }

    public function messages(){
        return[
            "start_time.required"=>"A mező kitöltése kötelező",
            "start_time.date"=>"A mező csak datetime formátumot fogad",

            "end_time.required"=>"A mező kitöltése kötelező",
            "end_time.date"=>"A mező csak datetime formátumot fogad",

            "price.required"=>"A mező kitöltése kötelező",
            "price.integer"=>"A mezőnek egész számnak kell lennie",
            
            "barber_id.required"=>"A mező kitöltése kötelező",
            "barber_id.integer"=>"A mezőnek egész számnak kell lennie",

            "customer_id.required"=>"A mező kitöltése kötelező",
            "customer_id.integer"=>"A mezőnek egész számnak kell lennie",

            "active.required"=>"A mező kitöltése kötelező",
            "active.boolean"=>"A mezőnek igaz/hamis értéknek kell lennie"
        ];
    }
}
