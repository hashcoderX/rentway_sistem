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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('amount')->nullable();
            $table->text('description')->nullable();
            $table->string('date_time')->nullable();  
            $table->double('payamount')->nullable();  
            $table->double('balance')->nullable();  
            $table->string('paytype')->nullable();  
            $table->text('payment_type')->nullable();  
            $table->string('month')->nullable();  
            $table->integer('invoiceid')->nullable();
            $table->string('paystatus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
