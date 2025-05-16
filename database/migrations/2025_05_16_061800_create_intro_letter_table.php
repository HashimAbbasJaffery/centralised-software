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
        Schema::create('intro_letter', function (Blueprint $table) {
            $table->id();
            $table->foreignId("member_id")->constrained("members")->cascadeOnDelete();
            $table->enum("spouse", [ "yes", "no" ]);
            $table->enum("children", [ "yes", "no" ]);
            $table->foreignId("club_id")->constrained("clubs")->cascadeOnDelete();
            $table->foreignId("duration_id")->constrained("durations")->cascadeOnDelete();
            $table->boolean("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intro_letter');
    }
};
