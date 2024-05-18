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
        Schema::create('users_answers_home_works', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->text('comment')->nullable();
            $table->integer('score')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('home_work_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('home_work_id')->references('id')->on('home_works');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_answers_home_works');
    }
};
