<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadLinkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'lead_name' => $this->lead_name,
            'county_code' => $this->county_code,
            'phone_number' => $this->phone_number,
            'token' => $this->token,
            'expires_at' => $this->expires_at,
            'status' => $this->status,
            'url' => route('lead.re-eligibility.form', $this->token),
        ];
    }
}
