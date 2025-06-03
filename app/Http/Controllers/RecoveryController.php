<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\DateFormatter;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class RecoveryController extends Controller
{
    public function __construct(public DateFormatter $dateFormatter, public ApiResponse $apiResponse) {}
    public function getSheet(Member $member) {
        $recovery_rows = $member->recovery;
        $late_payment_charges = $recovery_rows->sum("late_payment_charges");
        
        $now = \Carbon\Carbon::now();
        $formattedDate = $this->dateFormatter->calculateNext10thDay($now);
        
        $to_be_paid_row = $member
                            ->recovery()
                            ->whereRaw('? BETWEEN `month` AND `due_date`', [$now])
                            ->first();
                            
        $total_balance = $member->form_fee + $member->processing_fee + $member->first_payment + $member->total_installment + $late_payment_charges;
        return view("Invoices.recovery_sheet", compact(
            "recovery_rows",
            "member", 
            "late_payment_charges", 
            "formattedDate",
            "to_be_paid_row",
            "total_balance"
        ));
    }
    public function getReport() {
        return view("Recovery.generate-report");
    }
    public function generateReport() {
        $startDate = "2024-01-11";
        $endDate = "2025-02-10";
        $statuses = ["level3"];
        $members = Member::select("id", "member_name", "membership_number", "phone_number", "alternate_phone_number")
                                ->with(["recovery" => function($query) use($startDate, $endDate) {
                                    $query
                                        ->sum("recovery.payable")
                                        ->whereDate("month", ">=", $startDate)
                                        ->whereDate("due_date", "<=", $endDate);
                                }])
                                ->whereIn("payment_status", $statuses)
                                ->groupBy("id")
                                ->get();
        return view("Recovery.generate-report");
    }
    public function createReport() {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $statuses = explode(",", request()->statuses);
        
        $members = Member::select("id", "member_name", "membership_number", "phone_number", "alternate_ph_number", "payment_status")
                        ->withAndWhereHas("recovery", function($query) use($startDate, $endDate) {
                            $query->whereDate("month", ">=", $startDate)
                                    ->whereDate("due_date", "<=", $endDate)
                                    ->orderBy("id", "desc")
                                    ->limit(1);
                        })
                        ->when(!in_array("all", $statuses), function($query) use($statuses) {
                            $query->whereIn("payment_status", $statuses);
                        })
                        ->get();
        
        $sum = 0;
        // $members->each(function($member) use ($sum){
        //     $sum += $member->recovery->payable;
        // });

        return $this->apiResponse->success("Date has been fetched!", [$members, $sum]);
    }
    public function getOverall() {
        return view("Recovery.overall-report");
    }
}
