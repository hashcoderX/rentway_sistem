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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('fax');
            $table->string('userid');
            $table->string('manager_id')->nullable();
            $table->string('branchcode');
            $table->string('unit_head')->nullable();
            $table->string('firstlawyer')->nullable();
            $table->string('secound_lawyer')->nullable();
            $table->string('third_lawyer')->nullable();
            $table->string('forth_lawyer')->nullable();
            $table->string('date_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
