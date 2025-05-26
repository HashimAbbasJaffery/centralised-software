<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function get() {
        $paymentMethods = PaymentMethod::paginate(8);

        return PaymentMethodResource::collection($paymentMethods);
    }
}
