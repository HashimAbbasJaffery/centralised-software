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
        Schema::create('complain_questions', function (Blueprint $table) {
            $table->id();
            $table->string("question");
            $table->boolean("is_relevant");
            $table->string("answer")->nullable();
            $table->foreignId("complain_type_id")->constrained("complain_types")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complain_questions');
    }
};
