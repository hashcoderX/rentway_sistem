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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('company_id');
            $table->string('full_name')->nullable();
            $table->string('reg_date')->nullable();
            $table->string('nic')->nullable();
            $table->text('street')->nullable();
            $table->text('address_line_one')->nullable();
            $table->text('city')->nullable();
            $table->string('telephone_no')->nullable();
            $table->text('driving_licen_photo')->nullable();
            $table->text('livingvarification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
