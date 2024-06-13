<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassRoom>
 */
class ClassRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement(['Đại số 12','Hình học 11','Hóa 12', 'Anh 12', 'Văn 11', 'Lịch sử 10', 'Địa lí 9', 'Hóa học 8', 'Vật lí 7', 'Tiếng Anh 6']);
        $code = strtoupper($this->faker->bothify('???###'));
        $created_by = 1;

        return [
            'name' => $name,
            'code' => $code,
            'created_by' => $created_by,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ClassRoom $classRoom) {
            // Tạo bản ghi trong bảng trung gian user_class_rooms
            $user = User::factory()->create();
            $classRoom->users()->attach($user->id, [
                'content_role' => 'Chủ sở hữu',
            ]);
        });
    }
}
