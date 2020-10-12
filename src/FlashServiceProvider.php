<?php

namespace Jeremy379\Flash;

use Illuminate\Support\ServiceProvider;
use Jeremy379\Flash\SessionStore;
use Jeremy379\Flash\LaravelSessionStore;
use Jeremy379\Flash\FlashNotifier;

class FlashServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SessionStore::class,
	        LaravelSessionStore::class
        );

        $this->app->singleton('flash', function () {
            return $this->app->make(FlashNotifier::class);
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'flash');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/flash')
        ]);
    }

}
