<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppointmentServiceProvider extends ServiceProvider
{
    public function register()
    {
        //////////
    }
    public function boot()
    {
        // $this->app->router->group([
        //     'namespace' => 'App\Http\Controllers',
        //     'middleware' => 'api',
        //     'prefix' => 'api',
        // ], function ($router) {
        //     require base_path('routes/appointment.php');
        // });
    }
}
