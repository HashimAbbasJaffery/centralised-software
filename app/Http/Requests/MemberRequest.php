<?php

namespace App\Http\Requests;

use App\Models\CardType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class MemberRequest extends FormRequest
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
            "member_name" => [ "required" ],
            "date_of_birth" => [ "required" ],
            "gender" => [ "required" ],
            "marital_status" => [ "required" ],
            "cnic_passport" => [ "required" ],
            "phone_number" => [ "required" ],
            "alternate_ph_number" => [ "required" ],
            "email_address" => [ "required" ],
            "residential_address" => [ "required" ],
            "city_country" => [ "required" ],
            "membership_type" => [ "required" ],
            "membership_number" => [ "required" ],
            "membership_status" => [ "required" ],
            "file_number" => [ "required" ],
            "date_of_applying" => [ "required" ],
            "form_fee" => [ "required", "integer" ],
            "processing_fee" => [ "required", "integer" ],
            "first_payment" => [ "required", "integer" ],
            "installment_month" => [ "required", "integer" ],
            "total_installment" => [ "required", "integer" ],
            "blood_group" => [ "required" ],
            "emergency_contact" => [ "required" ],
            "card_type" => [ "required" ],
            "date_of_issue" => [ "required" ],
            "validity" => [ "required" ],
            "payment_status" => [ "required" ],
            "locker_category" => [ "required" ],
            "locker_number" => [ "required" ],
            "company_name" => [ "required" ],
            "company_designation" => [ "required" ],
            "profession" => [ "required" ]
        ];
    }
    public function withValidator($validator) {
        $corporateType = CardType::where("card_name", "corporate")->orWhere("card_name", "Corporate")->first();
        $extra_fields = [
            "office_address",
            "office_phone_number",
            "country",
            "city",
            "work_email"
        ];

        foreach($extra_fields as $extra_field) {
            $validator->sometimes($extra_field, 'required', function() use($corporateType) {
                return (int)$corporateType->id === (int)$this->membership_type;
            });
        }
    }
}
