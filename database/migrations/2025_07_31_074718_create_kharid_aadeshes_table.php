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
        Schema::create('kharid_aadeshes', function (Blueprint $table) {
            $table->id();

            // Vendor info
            $table->string('vendor_name')->nullable();
            $table->string('vendor_address')->nullable();
            $table->string('vendor_pan')->nullable();
            $table->string('vendor_phone')->nullable();

            // Fiscal and order info
            $table->unsignedBigInteger('fiscal_id');
            $table->string('order_no')->nullable();
            $table->date('order_date')->nullable(); // Nepali Date
            $table->string('proposal_no')->nullable();
            $table->date('proposal_date')->nullable();

            // Prepared by
            $table->string('prepared_by_name')->nullable();
            $table->string('prepared_by_position')->nullable();
            $table->date('prepared_by_date')->nullable();

            // Recommended by
            $table->string('recommended_by_name')->nullable();
            $table->string('recommended_by_position')->nullable();
            $table->date('recommended_by_date')->nullable();

            // Budget info
            $table->string('sub_heading_no')->nullable();
            $table->string('expenditure_title_no')->nullable();
            $table->string('activity_no')->nullable();

            // Financial admin
            $table->string('financial_admin_name')->nullable();
            $table->string('financial_admin_position')->nullable();
            $table->date('financial_admin_date')->nullable();

            // Approved by
            $table->string('approved_by_name')->nullable();
            $table->string('approved_by_position')->nullable();
            $table->date('approved_by_date')->nullable();

            // Vendor Commitment
            $table->date('vendor_commit_date')->nullable();
            $table->string('vendor_commit_location')->nullable();
            $table->string('vendor_commit_name')->nullable();
            $table->string('vendor_commit_signature')->nullable();
            $table->date('vendor_issued_date')->nullable();
            $table->string('vendor_commit_stamp')->nullable();

            // Grand Total
            $table->decimal('grand_total', 12, 2)->nullable();

            $table->foreign('fiscal_id')->references('id')->on('fiscal_years');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kharid_aadeshes');
    }
};
