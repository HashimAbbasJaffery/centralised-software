<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    public function getSheet(Member $member) {
        $recovery_rows = $member->recovery;
        $late_payment_charges = $recovery_rows->sum("late_payment_charges");
        
        $now = \Carbon\Carbon::now();

        if ($now->day > 10) {
            $dueDate = $now->copy()->addMonth()->day(10);
        } else {
            $dueDate = $now->copy()->day(10);
        }

        $formattedDate = $dueDate->format('d M Y');
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
}
