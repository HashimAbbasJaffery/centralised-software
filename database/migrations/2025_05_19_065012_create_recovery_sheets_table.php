<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recovery_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId("member_id")->constrained("members")->cascadeOnDelete();
            $table->date("month");
            $table->date("due_date");
            $table->string("payment_description");
            $table->float("current_month_payable");
            $table->float("late_payment_charges");
            $table->float("payable");
            $table->float("paid");
            $table->float("due_amount");
            $table->float("due_b_f");
            $table->float("main_balance");
            $table->float("total_sum_value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recovery_sheets');
    }
};
