<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function index() {
        $today = now();
        $end = now()->addDays(15);
        $members = Member::filter()
            ->orderBy("created_at", "desc")
            ->whereRaw("DATE_FORMAT(date_of_birth, '%m-%d') BETWEEN ? AND ?", [
                $today->format('m-d'),
                $end->format('m-d'),
            ])
            ->paginate(8);
        return MemberResource::collection($members);
    }
}
