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
        Schema::create('stationmasters', function (Blueprint $table) {
            $table->id();
            $table->string('staff_ID');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('department');
            $table->string('intercom');
            $table->string('stationmaster_ID');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('station');
            $table->string('password');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stationmasters');
    }
};
