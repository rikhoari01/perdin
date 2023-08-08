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
        Schema::create('perdins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('city_from');
            $table->integer('city_to');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('information', 255);
            $table->string('status');
            $table->integer('total_day');
            $table->integer('total_distance');
            $table->integer('total_fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perdins');
    }
};
