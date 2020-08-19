<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TimeTracker\Task\Domain\TaskRepository;
use TimeTracker\Task\Infrastructure\Persistence\TaskRepositoryRaw;

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
