<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecoveryResource;
use App\Jobs\PrepareRecoveryData;
use App\Models\Member;
use App\Models\RecoverySheet;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecoveryController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse, protected UserService $user) {
        $this->middleware("auth:sanctum");
    }
    public function index() {
        return view("Recovery.view-payment-schedule_2");
    }
    public function get(Member $member) {    
        return $this->apiResponse->success(
            "Recovery Data has been fetched!",
            RecoveryResource::collection($member->recovery)
        );
    }
    public function denormalise($value) {
        return (int) str_replace(',', '', $value);
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
                    "current_month_payable" => $this->denormalise($row["current_month_payable"]),
                    "late_payment_charges" => is_null($row["late_month_charges"]) ? null : $this->denormalise($row["late_month_charges"]),
                    "payable" =>  $this->denormalise($row["payable"]),
                    "paid" => $row["paid"] === null ? null : $this->denormalise($row["paid"]),
                    "due_amount" => $this->denormalise($row["due"]),
                    "due_b_f" => $this->denormalise($row["due_amount"]),
                    "main_balance" => $this->denormalise($row["balance"]),
                    "total_sum_value" => $this->denormalise($row["total_balance"]),
                ]);
            }

            
        });
        PrepareRecoveryData::dispatch($member);

        return $this->apiResponse->success("Recovery Sheet has been created/updated");
    }
    public function getMonthlyReport() {
        $from_date = request()->from_date;
        $to_date = request()->to_date;

        $recovery = RecoverySheet::selectRaw("
            month,
            MONTH(month) AS month_num,
            YEAR(month) AS year,
            SUM(CAST(REPLACE(current_month_payable, ',', '') AS UNSIGNED)) AS total_current_month_payable,
            SUM(CAST(REPLACE(payable, ',', '') AS UNSIGNED)) AS total_payable,
            SUM(CAST(REPLACE(paid, ',', '') AS UNSIGNED)) AS total_paid
        ")
            ->whereBetween(DB::raw('DATE(month)'), [$from_date, $to_date])
            ->groupByRaw('YEAR(month), MONTH(month), month')
            ->orderByRaw('YEAR(month), MONTH(month)')
            ->get();

        $total_current_month_payable = $recovery->sum("total_current_month_payable");
        $total_paid = $recovery->sum("total_paid");
        return $this->apiResponse->success("Recovery sheet has been fetched!", [$recovery, $total_current_month_payable, $total_paid]);
    }
}
