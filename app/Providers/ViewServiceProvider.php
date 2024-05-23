<?php

namespace App\Providers;

use App\Models\ClassRoom;
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
