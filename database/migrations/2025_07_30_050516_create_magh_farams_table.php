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
        Schema::create('magh_farams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiscal_id')->nullable();
            $table->unsignedBigInteger('month_id')->nullable();
            $table->string('form_no')->nullable();
            $table->date('date_ad')->nullable(); // Store AD date
            $table->string('purpose')->nullable();

            // Requested by
            $table->string('requested_by_name')->nullable();
            $table->string('requested_by_position')->nullable();
            $table->date('requested_by_date')->nullable();

            // Recommended by
            $table->string('recommended_by_name')->nullable();
            $table->string('recommended_by_position')->nullable();
            $table->date('recommended_by_date')->nullable();

            // Storekeeper section
            $table->string('store_action')->nullable();
            $table->string('storekeeper_signature')->nullable();
            $table->string('storekeeper_name')->nullable();

            // Receiver
            $table->string('receiver_name')->nullable();
            $table->string('receiver_position')->nullable();
            $table->date('receiver_date')->nullable();

            // Accountant
            $table->string('accountant_name')->nullable();
            $table->string('accountant_position')->nullable();
            $table->date('accountant_date')->nullable();

            // Approver
            $table->string('approver_name')->nullable();
            $table->string('approver_position')->nullable();
            $table->date('approver_date')->nullable();

            $table->foreign('fiscal_id')->references('id')->on('fiscal_years');
            $table->foreign('month_id')->references('id')->on('nepali_months');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magh_farams');
    }
};
