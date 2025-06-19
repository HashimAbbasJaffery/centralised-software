<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Member;

class CalculateFees implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Member $member,
        public $recovery_rows,
        public float $late_payment_charges,
        public string $formattedDate,
        public $to_be_paid_row
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $member = $this->member;

        $total_balance = $member->form_fee
            + $member->processing_fee
            + $member->first_payment
            + $member->total_installment
            + $this->late_payment_charges;

        // Pass data to PDF job
        GenerateRecoveryPDF::dispatch(
            $member,
            $this->recovery_rows,
            $this->late_payment_charges,
            $this->formattedDate,
            $total_balance,
            $this->to_be_paid_row
        );
    }
}
