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
        Schema::create('cashflotes', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->double('accountbalance')->nullable();
            $table->string('date_time')->nullable();
            $table->double('credit')->nullable();
            $table->double('debit')->nullable();
            $table->text('note')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashflotes');
    }
};
