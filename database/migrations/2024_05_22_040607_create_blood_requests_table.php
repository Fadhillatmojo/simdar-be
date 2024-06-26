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
        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_hf_id')->references('id')->on('health_facilities');
            $table->foreignId('responder_hf_id')->references('id')->on('health_facilities');
            $table->foreignId('responder_donor_id')->references('id')->on('donors');
            $table->integer('quantity');
            $table->enum('status', ['accepted', 'rejected', 'deleted', 'pending'])->default('pending');
            $table->string('purpose', 255);
            $table->string('reason', 255)->nullable();
            $table->date('request_date');
            $table->date('confirmed_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_requests');
    }
};
