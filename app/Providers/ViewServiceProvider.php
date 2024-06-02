<?php

namespace App\Providers;

use App\Models\ClassRoom;
use App\Models\Notification;
use App\Models\Topic;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::bind('id', function ($value) {
            return $value;
        });

        View::composer('*', function ($view) {
        $classId = request()->route('id');

        if (auth()->check()) {
            $userRole = auth()->user()->role;

            // Lấy ID của người dùng hiện tại
            $userId = auth()->user()->id;

            // Lấy loại thông báo dựa trên vai trò của người dùng
            $type = ($userRole == 2) ? 3 : 2;

            // Lấy ra thông báo phù hợp với vai trò của người dùng
            $notifications = Notification::whereHas('users', function ($query) use ($userId, $type) {
                $query->where('user_id', $userId)->where('type', $type);
            })->get();

            // lấy ra tổng số thông báo 
            $notificationCount = Notification::whereHas('users', function ($query) use ($userId, $type) {
                $query->where('user_id', $userId)->where('type', $type);
            })->count();

            $view->with([
                'notifications' => $notifications,
                'notificationCount' => $notificationCount
            ]);
        }

        if ($classId) {
            $classRoom = ClassRoom::find($classId);
            $topics = Topic::where('class_room_id', $classId)->get();
            $view->with([
                'classRoom' => $classRoom,
                'topics' => $topics,
            ]);
        }
    });
    }
}
