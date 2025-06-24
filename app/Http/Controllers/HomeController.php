<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $members_monthly = Member::whereMonth('created_at', Carbon::now()->month)->count();
        return view("dashboard", compact("members_monthly"));
    }
}
