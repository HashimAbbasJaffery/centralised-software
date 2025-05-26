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
            $table->date("month")->nullable();
            $table->date("due_date")->nullable();
            $table->string("payment_description")->nullable();
            $table->float("current_month_payable")->nullable();
            $table->float("late_payment_charges")->nullable();
            $table->float("payable")->nullable();
            $table->float("paid")->nullable();
            $table->float("due_amount")->nullable();
            $table->float("due_b_f")->nullable();
            $table->float("main_balance")->nullable();
            $table->float("total_sum_value")->nullable();
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
