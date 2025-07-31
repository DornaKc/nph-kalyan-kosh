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
        Schema::create('kharid_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kharid_aadesh_id');
            $table->string('code')->nullable();             // सङ्केत नं.
            $table->string('name')->nullable();             // नाम
            $table->string('specification')->nullable();    // स्पेसिफिकेसन
            $table->string('model')->nullable();            // मोडल
            $table->string('unit')->nullable();             // इकाई
            $table->integer('quantity')->nullable();        // परिमाण
            $table->decimal('unit_price', 10, 2)->nullable(); // दर
            $table->decimal('total', 12, 2)->nullable();    // जम्मा
            $table->string('remarks')->nullable();          // कैफियत

            $table->foreign('kharid_aadesh_id')->references('id')->on('kharid_aadeshes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kharid_items');
    }
};
