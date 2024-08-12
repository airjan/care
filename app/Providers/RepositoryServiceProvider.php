<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
        EventsRepository,
        EventsInviteeRepository
    };
use App\Interfaces\{
        EventsInterface,
        EventInviteeInterface
    };

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(EventsInterface::class, EventsRepository::class);
        $this->app->bind(EventInviteeInterface::class, EventsInviteeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
