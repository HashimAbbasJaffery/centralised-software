<?php

namespace App\Jobs;

use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateFamilySheet implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Member $member)
    {
        //
    }

    /**
     * Execute the job.
     * 
     */
    public function handle(): void
    {
        // $pdf = Pdf::loadView("Invoices.member_tree", [ "member" => $this->member ])
        // ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        // ->setPaper("A4", "portrait");
        Log::info(Storage::disk('public')->exists($this->member->profile_picture));
        
        // $pdfContent = $pdf->output();
        // $fileName = $this->member->member_name . "-" . $this->member->id;
        // $filePath = "members/FamilySheet/" . $fileName . ".pdf";
        // Storage::disk("public")->put($filePath, $pdfContent);

        // $this->member->has_receipt_created = true;
        // $this->member->save();

    }
}
