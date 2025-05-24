<?php

namespace App\Service;

use App\Models\Receipt;

class UniqueCodeService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function generateUniqueCode($length) {
        do {
            $code = str_pad(random_int(0, 999999), $length, '0', STR_PAD_LEFT);
        } while(Receipt::where("receipt_id", $code)->exists());

        return $code;
    }
}
