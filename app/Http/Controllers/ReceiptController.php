<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReceiptResource;
use App\Models\Member;
use App\Models\PaymentMethod;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function create() {
        $payment_methods = PaymentMethod::all();
        return view("Receipt.create", compact("payment_methods"));
    }
    public function get() {
        return view("Receipt.index");
    }
    public function update(Receipt $receipt) {
        $payment_methods = PaymentMethod::all();
        $receipt->load(["payment_method", "member"]);
        return view("Receipt.update", compact("payment_methods", "receipt"));
    }
}
