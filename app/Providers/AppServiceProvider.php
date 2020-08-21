<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Domain\TaskTimeRepository;
use TimeTracker\Task\Infrastructure\Persistence\TaskRepositoryRaw;
use TimeTracker\Task\Infrastructure\Persistence\TaskTimeRepositoryRaw;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TaskRepository::class,
            TaskRepositoryRaw::class
        );

        $this->app->bind(
            TaskTimeRepository::class,
            TaskTimeRepositoryRaw::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
