<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "member_name" => $this->member_name,
            "date_of_birth" => $this->date_of_birth,
            "gender" => $this->gender,
            "marital_status" => $this->marital_status,
            "cnic_passport" => $this->cnic_passport,
            "phone_number" => $this->phone_number,
            "alternate_ph_number" => $this->alternate_ph_number,
            "email_address" => $this->email_address,
            "residential_address" => $this->residential_address,
            "city_country" => $this->city_country,
            "membership_type" => $this->membership_type,
            "membership_number" => $this->membership_number,
            "membership_status" => $this->membership_status,
            "file_number" => $this->file_number,
            "date_of_applying" => $this->date_of_applying,
            "form_fee" => $this->form_fee,
            "processing_fee" => $this->processing_fee,
            "first_payment" => $this->first_payment,
            "total_installment" => $this->total_installment,
            "sum" => $this->form_fee + $this->processing_fee + $this->first_payment + $this->total_installment,
            "blood_group" => $this->blood_group,
            "emergency_contact" => $this->emergency_contact,
            "profile_picture" => $this->profile_picture,
            "card_type" => $this->card_type,
            "date_of_issue" => $this->date_of_issue,
            "validity" => $this->validity,
            "spouses" => $this->spouses,
            "children" => $this->children
        ];
    }
}
