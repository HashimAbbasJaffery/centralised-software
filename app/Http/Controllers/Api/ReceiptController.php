<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptRequest;
use App\Http\Resources\ReceiptResource;
use App\Jobs\CreateReceipt;
use App\Models\Member;
use App\Models\Receipt;
use App\Service\UniqueCodeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse, protected UniqueCodeService $uniqueCodeService) {}
    public function store(ReceiptRequest $request, Member $member) {
        $receipt = $member->receipts()->create([ ...$request->validated(), "receipt_id" => $this->uniqueCodeService->generateUniqueCode(6) ]);

        $receipt = $receipt->load(["member", "payment_method"]);
        dispatch(new CreateReceipt($receipt));

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
                    })->orderBy("created_at", "desc")->paginate(8);


        return ReceiptResource::collection($receipts);
    }
    public function delete(Receipt $receipt) {
        if(!$receipt->exists()) throw new ModelNotFoundException("Receipt Not found!");

        $receipt->delete();

        return $this->apiResponse->success("Receipt has been deleted");
    }

    public function download(Receipt $receipt) {
        $fileName = "Receipt-{$receipt->receipt_id}-{$receipt->member->member_name}.pdf";
        return Storage::disk("local")->download("recovery/receipts/$fileName");
    }
}
