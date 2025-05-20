<?php

namespace App\Repository;

use App\Models\Member;

class MemberRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getRecoveries(Member $member, $now) {
        $to_be_paid_row = $member
                            ->recovery()
                            ->whereRaw('? BETWEEN `month` AND `due_date`', [$now])
                            ->first();
        return $to_be_paid_row;
    }
}
