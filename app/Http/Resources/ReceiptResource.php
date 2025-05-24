<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceiptResource extends JsonResource
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
            "member" => $this->member->member_name,
            "paid_amount" => $this->paid_amount,
            "reference_number" => $this->reference_number,
            "payment_method" => $this->payment_method->payment_method,
            "date" => $this->date,
            "receipt_status" => $this->receipt_status
        ];
    }
}
