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
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->string("designation");
            $table->string("type_of_profession");
            $table->string("office_address")->nullable();
            $table->string("office_phone_number")->nullable();
            $table->string("country")->nullable();
            $table->string("city")->nullable();
            $table->string("work_email")->nullable();
            $table->foreignId("member_id")->constrained("members")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};
