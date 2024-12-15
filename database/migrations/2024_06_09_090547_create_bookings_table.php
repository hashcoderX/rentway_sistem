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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('book_date')->nullable();
            $table->string('pick_time')->nullable();
            $table->string('booked_date')->nullable();
            $table->string('booked_time')->nullable();
            $table->string('customer_name')->nullable();
            $table->integer('customer_id')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
