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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('type')->nullable();
            $table->text('notification_level')->nullable();
            $table->string('read_state')->nullable();
            $table->text('topic')->nullable();
            $table->string('notifiaction_date_start')->nullable();
            $table->string('notification_date_end')->nullable();
            $table->string('time')->nullable();
            $table->text('description')->nullable();
            $table->string('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
