<?php

namespace App\Providers;


use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
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
        if($this->app->environment('production')){
            URL::forceScheme('https');
        }

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return 'https://example.com/reset-password?token='.$token;
        });
    }
}
