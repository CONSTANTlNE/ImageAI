<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

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
        URL::forceScheme('https');
        Model::preventLazyLoading(!app()->isProduction());

        // To be available only for certain users
        LogViewer::auth(function ($request) {
            return $request->user()
                && $request->user()->email === 'gmta.constantine@gmail.com';
        });

        // To be available only for certain users
        LogViewer::auth(function ($request) {
            return $request->user()
                && in_array($request->user()->email, [
                    'gmta.constantine@gmail.com',
                ]);
        });

        View::composer('*', function ($view) {
            // Use a static variable to store languages and only fetch once per request
            static $languages = null;

            if ($languages === null) {
                $languages = Language::all();
            }

            $view->with('languages', $languages);
        });
    }
}
