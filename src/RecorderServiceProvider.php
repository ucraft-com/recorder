<?php

declare(strict_types = 1);

namespace Uc\Recorder;

use Illuminate\Support\ServiceProvider;
use Uc\Recorder\Providers\EventServiceProvider;

/**
 * Service provider of the package.
 */
class RecorderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'recorder');
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__.'/../config/config.php' => config_path('recorder.php'),
                ],
                'recorder-config'
            );
        }
    }
}
