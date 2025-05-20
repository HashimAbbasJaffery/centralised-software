<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecoveryResource;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecoveryController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function index() {
        return view("Recovery.view-payment-schedule_2");
    }
    public function get(Member $member) {
        return $this->apiResponse->success(
            "Recovery Data has been fetched!", 
            RecoveryResource::collection($member->recovery)
        );
    }
    public function store(Member $member) {
        $rows = request()->rows;
        DB::transaction(function() use($rows, $member) {

            $member->recovery()->delete();

            foreach($rows as $row) {
                $member->recovery()->create([
                    "month" => $row["month"],
                    "due_date" => $row["due_date"],
                    "payment_description" => $row["payment_description"],
                    "current_month_payable" => $row["current_month_payable"],
                    "late_payment_charges" => $row["late_month_charges"],
                    "payable" => $row["payable"],
                    "paid" => $row["paid"],
                    "due_amount" => $row["due"],
                    "due_b_f" => $row["due_amount"],
                    "main_balance" => $row["balance"],
                    "total_sum_value" => $row["total_balance"]
                ]);
            }

        });

        return $this->apiResponse->success("Recovery Sheet has been created/updated");
    }
}
