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
            $table->string('title')->nullable();
            $table->text('content');
            $table->integer('type')->comment('1: Thông báo, 2: TB tạo lớp, 3: Gửi lời mời giáo viên, 4: Tham gia lớp');
            $table->integer('is_accept')->default(0)->comment('0: Chưa xác nhận, 1: Đã xác nhận');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->timestamps();

            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
