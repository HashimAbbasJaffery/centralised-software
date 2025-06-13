<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    public function __construct(protected ApiResponse $apiResponse) {
        $this->middleware("auth:sanctum");
    }
    public function get(Request $request) {
        $keyword = $request->keyword;
        $paymentMethods = PaymentMethod::whereLike("payment_method", "%$keyword%")->get();

        return PaymentMethodResource::collection($paymentMethods);
    }

    public function getAndPaginate(Request $request) {
        
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "payment_method" => [ "required" ]
        ]);

        if($validator->fails()) {
            return $this->apiResponse->error(422, "Payment Method Field must be filled");
        }

        $payment_method = PaymentMethod::create($validator->validated());

        return $this->apiResponse->success("Payment Method has been inserted!", [ "id" => $payment_method->id ]);
    }
    public function destroy(PaymentMethod $paymentMethod) {
        if(!$paymentMethod->exists()) {
            throw new ModelNotFoundException("Payment Method not found!");
        }

        $paymentMethod->delete();

        return $this->apiResponse->success("Payment Method has been deleted!");
    }
}
