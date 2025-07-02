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
        $recent_member = Member::latest()->limit(1)->get();
        $total_clubs = Club::count();
        $famous_club = Club::withCount("introletters")
                                ->orderByDesc("introletters_count")
                                ->limit(1)
                                ->first();
        
        return view("dashboard", compact("members_monthly", "total_clubs", "famous_club", "recent_member"));
    }
}
