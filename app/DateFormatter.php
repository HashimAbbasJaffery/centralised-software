<?php

namespace App;

class DateFormatter
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function calculateNext10thDay($now) {
        if ($now->day > 10) {
            $dueDate = $now->copy()->addMonth()->day(10);
        } else {
            $dueDate = $now->copy()->day(10);
        }

        $formattedDate = $dueDate->format('d M Y');

        return $formattedDate;
    }
}
