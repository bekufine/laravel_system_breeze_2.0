<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        
        Gate::define("access_to_profile", function (User $user){

            return $user->role->value===("area_manager");
        });

        Gate::define("has_access_to_order", function(User $user, Order $order){
            $user_city = $user->city;
            
            return $order->hotel->city ===$user_city;
        });
    }
}
