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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->string("member_name")->index("idx_member_name");
            $table->date("date_of_birth");
            $table->enum("gender", ["male", "female"])->default("male");
            $table->string("marital_status");
            $table->string("cnic_passport");

            $table->string("phone_number");
            $table->string("phone_number_code");
            $table->string("alternate_ph_number");
            $table->string("alternate_ph_number_code");
            $table->string("email_address");
            $table->string("residential_address");
            $table->string("city_country");

            $table->foreignId("membership_type")->constrained("card_types")->cascadeOnDelete();
            $table->string("membership_number")->index("idx_membership_number");
            $table->string("membership_status");
            $table->string("file_number");
            $table->date("date_of_applying");

            // Step 4 will consist of spouses and children. and that will be available in other database

            $table->float("form_fee")->default(0);
            $table->float("processing_fee")->default(0);
            $table->float("first_payment")->default(0);
            $table->float("total_installment")->default(0);
            $table->float("installment_month")->default(0);
            $table->string("payment_status");

            $table->string("blood_group");
            $table->string("emergency_contact");
            $table->string("emergency_contact_code");

            $table->string("profile_picture")->default("profile_pictures/default-user.png");
            $table->string("card_type");
            $table->date("date_of_issue")->default(now());
            $table->date("validity")->default(now());

            $table->boolean("has_receipt_created")->default(false);

            $table->uuid("user_token")->unique();
            $table->string("recovery_phone_number")->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
