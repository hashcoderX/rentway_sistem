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
        Schema::create('vehicle_has_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('book_start_date')->nullable();
            $table->string('pick_time')->nullable();
            $table->text('pick_location')->nullable();
            $table->text('wheretogo')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_time')->nullable();
            $table->text('return_location')->nullable();
            $table->string('book_time')->nullable();
            $table->string('isdriver')->nullable();
            $table->string('hire_location')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->integer('customer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_has_bookings');
    }
};
