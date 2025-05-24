<?php

namespace App\Jobs;

use App\Models\Receipt;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CreateReceipt implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Receipt $receipt) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf = Pdf::loadView("Invoices.recovery_receipt", [ "receipt" => $this->receipt ])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper([0, 0, 419.53, 595.28], 'portrait');
   
        $pdfContent = $pdf->output();
        $fileName = "Receipt-{$this->receipt->receipt_id}-{$this->receipt->member->member_name}";
        $filePath = "recovery/receipts/" . $fileName . ".pdf";
        Storage::put($filePath, $pdfContent);

        $this->receipt->update([
            "receipt_status" => "created"
        ]);
    }
}
