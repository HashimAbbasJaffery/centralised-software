<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecoveryResource extends JsonResource
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
            "month" => $this->month,
            "due_date" => $this->due_date,
            "payment_description" => $this->payment_description,
            "current_month_payable" => $this->current_month_payable,
            "late_month_charges" => $this->late_payment_charges,
            "payable" => $this->payable,
            "paid" => $this->paid,
            "due_amount" => $this->due_amount,
            "due" => $this->due_b_f,
            "balance" => $this->main_balance,
            "total_balance" => $this->total_sum_value
        ];
    }
}
