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
        Schema::create('blood_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_donor_id')->references('id')->on('donors');
            $table->foreignId('stock_id')->references('id')->on('blood_stocks');
            $table->foreignId('hf_id')->references('id')->on('health_facilities');
            $table->string('purpose', 255);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_usages');
    }
};
