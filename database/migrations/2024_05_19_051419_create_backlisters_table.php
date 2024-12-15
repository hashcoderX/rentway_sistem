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
        Schema::create('backlisters', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('reg_date')->nullable();
            $table->string('nic')->nullable();
            $table->text('address')->nullable();
            $table->string('telephone_no')->nullable();
            $table->text('driving_licen_photo')->nullable();
            $table->text('effected_company_name')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_contact_no')->nullable();
            $table->text('type_of_damage')->nullable();
            $table->text('resone_describe')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backlisters');
    }
};
