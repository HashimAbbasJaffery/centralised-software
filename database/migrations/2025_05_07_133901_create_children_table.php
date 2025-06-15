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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
// children: [{id: 1, childName: "", cnic: "", dob: "", date_of_issue: "", validity: "", blood_group: "", profile_pic: "", hidden: false}],
            $table->string("cnic");
            $table->string("child_name");
            $table->date("date_of_birth");
            $table->date("date_of_issue");
            $table->date("validity");
            $table->string("blood_group");
            $table->string("profile_pic");
            $table->foreignId("member_id")->constrained("members")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
