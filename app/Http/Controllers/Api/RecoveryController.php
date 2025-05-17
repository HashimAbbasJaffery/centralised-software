<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecoveryController extends Controller
{
    public function index() {
        return view("Recovery.view-payment-schedule");
    }
}
