<?php

namespace LIBRESSLtd\LBUserManual;

use Illuminate\Support\ServiceProvider;

class LBUserManualServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->publishes([
            __DIR__.'/jobs' => base_path('app/Jobs'),
            __DIR__.'/migrations' => base_path('database/migrations'),
            __DIR__.'/models' => base_path('app/Models'),
            __DIR__.'/views' => base_path('resources/views/libressltd'),
	    ], 'lbusermanual');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__.'/routes.php';
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\LBUM_generateController');
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\LBUM_documentController');
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\LBUM_documentFunctionController');
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\LBUM_functionStepController');
        
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\Ajax\LBUM_documentController');
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\Ajax\LBUM_documentFunctionController');
        $this->app->make('LIBRESSLtd\LBUserManual\Controllers\Ajax\LBUM_functionStepController');
    }
}
