<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BirthdayController extends Controller
{
    public function __construct(protected UserService $user) {
        $this->middleware("auth:sanctum");
    }
    public function index() {
        $this->user->isAllowedToPerformAction("member:birthdays");

       
        $today = now();
        $end = now()->addDays(15);

        $start_md = $today->format('m-d');
        $end_md = $end->format('m-d');

        $members = Member::filter()
            ->whereNotIn("payment_status", ["level3", "level4"])
            ->where(function ($query) use ($start_md, $end_md) {
                if ($start_md <= $end_md) {
                    $query->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') BETWEEN ? AND ?", [$start_md, $end_md]);
                } else {
                    $query->where(function ($q) use ($start_md, $end_md) {
                        $q->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') >= ?", [$start_md])
                        ->orWhereRaw("DATE_FORMAT(date_of_birth, '%m-%d') <= ?", [$end_md]);
                    });
                }
            })
            ->orderByRaw("MONTH(date_of_birth), DAY(date_of_birth)")
            ->orderBy("created_at", "desc")
            ->paginate(8);



            Log::info($members);
        return MemberResource::collection($members);
    }
}
