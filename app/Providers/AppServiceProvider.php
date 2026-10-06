<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (
            $this->app->environment('production')
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
            || (isset($_SERVER['HTTP_HOST']) && str_contains($_SERVER['HTTP_HOST'], 'railway.app'))
        ) {
            URL::forceScheme('https');
        }

        View::composer('components.layouts.site', function ($view) {
            $view->with([
                'profile' => Cache::rememberForever('profile', fn () => Profile::current()),
                'setting' => Cache::rememberForever('settings', fn () => Setting::current()),
                'socials' => Cache::rememberForever('socials', fn () => SocialLink::ordered()->get()),
            ]);
        });

        View::composer('components.admin.layout', function ($view) {
            $view->with('unreadMessages', Cache::rememberForever('unread-messages', fn () => Contact::unread()->count()));
        });
    }
}