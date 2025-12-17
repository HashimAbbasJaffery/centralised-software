<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Service\UserService;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function __construct(protected UserService $user)
    {
        $this->middleware("auth:sanctum");
    }
    public function index()
    {
        $this->user->isAllowedToPerformAction("member:birthdays");

        $today = now();
        $end = $today->copy()->addDays(15);

        $todayMd = $today->format('m-d');
        $endMd = $end->format('m-d');

        $members = Member::filter()
            ->whereNotIn('payment_status', ['level3', 'level4'])
            ->where(function ($q) use ($todayMd, $endMd) {

                // Same month range
                if ($todayMd <= $endMd) {
                    $q->whereRaw(
                        "DATE_FORMAT(date_of_birth, '%m-%d') BETWEEN ? AND ?",
                        [$todayMd, $endMd]
                    );
                }
                // Month / year cross (Dec → Jan)
                else {
                    $q->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') >= ?", [$todayMd])
                        ->orWhereRaw("DATE_FORMAT(date_of_birth, '%m-%d') <= ?", [$endMd]);
                }

            })
            ->orderByRaw("
                CASE 
                    WHEN DATE_FORMAT(date_of_birth, '%m-%d') >= ? THEN 0
                    ELSE 1
                END,
                MONTH(date_of_birth),
                DAY(date_of_birth)
            ", [$todayMd])
            ->paginate(8)
        ;

        return MemberResource::collection($members);
    }
}
