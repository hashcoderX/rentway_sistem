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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_code')->nullable(); 
            $table->string('reg_no')->nullable();
            $table->string('register_date')->nullable();
            $table->string('email')->nullable(); 
            $table->string('password')->nullable();
            $table->text('address')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('contact_no')->nullable(); 
            $table->string('mobile_number')->nullable();
            $table->text('website')->nullable();
            $table->text('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('payby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};