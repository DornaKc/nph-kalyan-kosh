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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fiscal_id');
            $table->string('budget_title')->nullable();
            $table->string('budget_type')->nullable();
            $table->integer('allocated_amount')->nullable();
            $table->integer('expenditure')->nullable();
            $table->integer('balance')->nullable();
            $table->date('date_bs')->nullable();
            $table->date('date_ad')->nullable();
            $table->text('remarks')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
