<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $members_monthly = Member::whereMonth('created_at', Carbon::now()->month)->count();
        $total_clubs = Club::count();

        return view("dashboard", compact("members_monthly", "total_clubs"));
    }
}
