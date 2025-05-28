<?php

namespace App\Http\Controllers;

use App\Models\ComplainType;
use Illuminate\Http\Request;

class ComplainTypeController extends Controller
{
    public function index() {
        return view("Complains.Complain Types.index");
    }
}
