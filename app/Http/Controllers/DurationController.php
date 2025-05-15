<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DurationController extends Controller
{
    public function index() {
        return view("Duration.index");
    }
}
