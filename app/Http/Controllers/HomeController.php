<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Club;
use App\Models\Member;
use App\Models\RecoverySheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $members_monthly = Member::whereMonth('created_at', Carbon::now()->month)->count();
        $recent_member = Member::latest()->limit(1)->first();
        $total_clubs = Club::count();
        $famous_club = Club::withCount("introletters")
                                ->orderByDesc("introletters_count")
                                ->limit(1)
                                ->first();
        
        $today = now();

        $memberships = CardType::withCount("members", "spouses", "children")
                                ->get();
        
        $lastYear = now()->subYear();
        $currentYear = now()->year;

        $lastYearRecoverySheet = RecoverySheet::selectRaw("SUM(paid) AS paid, MONTH(month)")
                                        ->whereYear("month", ">=", $lastYear)
                                        ->whereYear("due_date", "<=", $lastYear)
                                        ->groupByRaw("MONTH(month)")
                                        ->get();

                                        
        $currentYearRecoverySheet = RecoverySheet::selectRaw("SUM(paid) AS paid, MONTH(month)")
                                        ->whereYear("month", ">=", $currentYear)
                                        ->whereYear("due_date", "<=", $currentYear)
                                        ->groupByRaw("MONTH(month)")
                                        ->get();

        $lastYearRecoverySheet->map(function($year) {
            if($year->paid === null) {
                $year->paid = 0;
            }
            return $year;
        });

        $currentYearRecoverySheet->map(function($year) {
            if($year->paid === null) {
                $year->paid = 0;
            }
            return $year;
        });

        return view("dashboard", compact("members_monthly", "total_clubs", "famous_club", "recent_member", "memberships", "lastYearRecoverySheet", "currentYearRecoverySheet"));
    }
}
