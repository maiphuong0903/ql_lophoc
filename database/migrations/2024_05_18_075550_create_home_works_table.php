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
        Schema::create('home_works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('created_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->string('homework_file');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->unsignedBigInteger('class_room_id');
            $table->timestamps();

            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_works');
    }
};
