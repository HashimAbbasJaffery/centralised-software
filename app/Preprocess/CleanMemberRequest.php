<?php

namespace App\Preprocess;

use App\Http\Requests\MemberRequest;

class CleanMemberRequest
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function clean(MemberRequest $request) {
        $spouses = request()->spouses;
        $children = request()->children;

        $children = collect($children)->filter(function($child) {
            return !in_array(null, $child, true);
        });
        $spouses = collect($spouses)->filter(function($spouse) {
            return !in_array(null, $spouse, true);
        });

        $phone_numbers = json_decode(request()->phone_numbers);

        return [$children, $spouses, $phone_numbers];
    }
}
