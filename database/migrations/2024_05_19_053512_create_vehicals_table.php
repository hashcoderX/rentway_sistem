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
        Schema::create('vehicals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('vehical_no')->nullable();
            $table->string('vehical_type')->nullable();
            $table->string('vehical_brand')->nullable();
            $table->string('body_type')->nullable();
            $table->string('vehical_model')->nullable();
            $table->string('meeter')->nullable();
            $table->string('licen_exp')->nullable();
            $table->string('insurence_exp')->nullable();
            $table->string('per_day_rental')->nullable();
            $table->string('per_week_rental')->nullable();
            $table->string('per_month_rental')->nullable();
            $table->string('per_year_rental')->nullable();
            $table->string('per_day_free_duration')->nullable();
            $table->string('per_week_free_duration')->nullable();
            $table->string('per_month_free_duration')->nullable();
            $table->string('per_year_free_duration')->nullable();
            $table->string('addtional_per_mile_cost')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('avalibility')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicals');
    }
};
