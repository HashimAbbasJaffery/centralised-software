<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class GenerateRecoveryPDF implements ShouldQueue
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
        public float $total_balance,
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
           $pdf = Pdf::loadView("Invoices.recovery_sheet", [
            "late_payment_charges" => $this->late_payment_charges,
            "formattedDate" => $this->formattedDate,
            "recovery_rows" => $this->recovery_rows,
            "to_be_paid_row" => $this->to_be_paid_row,
            "member" => $this->member,
            "total_balance" => $this->total_balance
        ])
        ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->setPaper('A4', 'portrait');

        // Store, mail, or return the PDF here
        Storage::put('pdfs/recovery_'.$this->member->id.'.pdf', $pdf->output());

    }
}
