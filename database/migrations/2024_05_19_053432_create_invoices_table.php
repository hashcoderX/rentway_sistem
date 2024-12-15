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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('company_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('guarantor_id')->nullable();
            $table->integer('bookingid')->nullable();
            $table->text('customername')->nullable();
            $table->string('starting_meeter')->nullable();
            $table->string('endmeeter')->nullable();
            $table->string('type_of_rent')->nullable();
            $table->string('addtional_mile_chargers')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->double('extra_charges')->nullable();
            $table->string('extra_for_description')->nullable();
            $table->text('description')->nullable();
            $table->double('advance_charge')->nullable();
            $table->double('total_bill')->nullable();
            $table->double('discount')->nullable();
            $table->double('net_total')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('invoice_compleat_date')->nullable();
            $table->string('issue_type')->nullable();
            $table->string('extra_drive_amount')->nullable();
            $table->string('extramillege')->nullable();
            $table->string('totaldrivedistance')->nullable();
            $table->string('bamount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
