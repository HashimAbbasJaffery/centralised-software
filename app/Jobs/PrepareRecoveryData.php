<?php

namespace App\Jobs;

use App\DateFormatter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Member;

class PrepareRecoveryData implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Member $member)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $member = $this->member;
        $recovery_rows = $member->recovery;
        $late_payment_charges = $recovery_rows->sum("late_payment_charges");

        $now = \Carbon\Carbon::now();
        $formattedDate = app(DateFormatter::class)->calculateNext10thDay($now);

        $to_be_paid_row = $member->recovery()
            ->whereRaw('? BETWEEN `month` AND `due_date`', [$now])
            ->first();

        CalculateFees::dispatch($member, $recovery_rows, $late_payment_charges, $formattedDate, $to_be_paid_row);
 
    }
}
