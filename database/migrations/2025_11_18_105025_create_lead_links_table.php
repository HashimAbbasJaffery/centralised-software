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
        Schema::create('lead_links', function (Blueprint $table) {
            $table->id();
            $table->string('lead_name');
            $table->string('county_code');
            $table->string('phone_number');
            $table->string('token')->unique();
            $table->timestamp('expires_at')->nullable();
            $table->enum('status', ['active', 'expired', 'used'])->default('active');
            $table->timestamps();

            // index 
            $table->index('lead_name');
            $table->index('county_code');
            $table->index('phone_number');
            $table->index('token');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_links');
    }
};
