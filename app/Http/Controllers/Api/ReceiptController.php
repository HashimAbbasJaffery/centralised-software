<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptRequest;
use App\Http\Resources\ReceiptResource;
use App\Models\Member;
use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {}
    public function store(ReceiptRequest $request, Member $member) {
        $receipt = $member->receipts()->create($request->validated());

        $receipt = $receipt->load(["member", "payment_method"]);
        $pdf = PDF::loadView("Invoices.recovery_receipt", [ "receipt" => $receipt ])
                    ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper([0, 0, 419.53, 595.28], 'portrait');
                    
        $pdfContent = $pdf->output();
        $filePath = "recovery/receipts/" . $receipt->id . ".pdf";
        Storage::put($filePath, $pdfContent);

        return $this->apiResponse->success("Receipt has been created");
    }
    public function edit(ReceiptRequest $request, Receipt $receipt) {
        $receipt->update([...$request->validated(), "member_id" => $request->member_id]);

        return $this->apiResponse->success("Receipt has been updated");
    }
    public function get() {
        $keyword = request()->keyword;
 
        $receipts = Receipt::where(function ($query) use ($keyword) {
                        $query->whereHas("member", function($q) use ($keyword) {
                            $q->where("member_name", "like", "%$keyword%");
                        })
                        ->orWhere("paid_amount", "like", "%$keyword%")
                        ->orWhere("reference_number", "like", "%$keyword%")
                        ->orWhereHas("payment_method", function($q) use ($keyword) {
                            $q->where("payment_method", "like", "%$keyword%");
                        });
                    })->paginate(8);


        return ReceiptResource::collection($receipts);
    }
    public function delete(Receipt $receipt) {
        if(!$receipt->exists()) throw new ModelNotFoundException("Receipt Not found!");

        $receipt->delete();

        return $this->apiResponse->success("Receipt has been deleted");
    }
}
