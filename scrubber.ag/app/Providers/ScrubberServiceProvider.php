<?php

namespace App\Providers;

use App\Helpers\ScrubberInit;
use Illuminate\Support\ServiceProvider;

class ScrubberServiceProvider extends ServiceProvider
{

    protected $defer = true;

    protected $test;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind('App\Helpers\Contracts\ScrubberBaseContract', function() {
        //   return new ScrubberInit();
        //});
        $this->app->bind('App\Helpers\Contracts\ScrubberBaseContract', 'App\Helpers\ScrubberInit');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\Contracts\ScrubberBaseContract'];
    }

    //protected function init() {
    //    $this->test = new \stdClass();
    //    $this->test->site = explode(".", $this->app['request']->server('HTTP_HOST'))[0];
    //    $this->test->token = "";
    //    $this->test->direction = "";
    //    $this->test->action = "";
    //    $this->test->scrubber = "";
    //    $this->test->scrubberType = "";
    //}
}
