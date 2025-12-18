<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (app()->environment('local') && ! app()->runningInConsole()) {
            URL::forceRootUrl(request()->getSchemeAndHttpHost());

            config([
                'filesystems.disks.public.url' => request()->getSchemeAndHttpHost() . '/storage',
            ]);

            if (config('session.domain') === 'null') {
                config([
                    'session.domain' => null,
                ]);
            }
        }
    }
}
