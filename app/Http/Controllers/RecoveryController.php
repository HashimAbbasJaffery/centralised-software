<?php

namespace App\Http\Controllers;

use App\DateFormatter;
use App\Models\Member;

class RecoveryController extends Controller
{
    public function __construct(public DateFormatter $dateFormatter) {}
    public function getSheet(Member $member) {
        $recovery_rows = $member->recovery;
        $late_payment_charges = $recovery_rows->sum("late_payment_charges");
        
        $now = \Carbon\Carbon::now();
        $formattedDate = $this->dateFormatter->calculateNext10thDay($now);
        
        $to_be_paid_row = $member
                            ->recovery()
                            ->whereRaw('? BETWEEN `month` AND `due_date`', [$now])
                            ->first();
                            

        return view("Invoices.recovery_sheet", compact(
            "recovery_rows",
            "member", 
            "late_payment_charges", 
            "formattedDate",
            "to_be_paid_row"
        ));
    }
    public function getReport() {
        return view("Recovery.generate-report");
    }
    public function generateReport() {
        
    }
}
