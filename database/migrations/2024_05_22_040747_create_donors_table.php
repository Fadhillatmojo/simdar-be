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
        Schema::create('donors', function (Blueprint $table) {
            $table->id('donor_id');
            $table->string('name', 255);
            $table->enum('gender', ['L', 'P']);
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->enum('rhesus_type', ['negatif', 'positif']);
            $table->date('date_of_birth');
            $table->string('address', 255);
            $table->string('phone_number', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
