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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime("start_time");
            $table->decimal("price");
            $table->foreignId("barber_id");
            $table->foreignId("customer_id");
            //$table->foreignId("services"); -THIS IS REPLACED BY A CONNECTING TABLE'S ID-
            $table->boolean("active");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
