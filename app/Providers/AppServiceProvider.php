<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\AuditLogObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register audit log observers for all auditable models
        AuditLogObserver::registerObservers();
    }
}
