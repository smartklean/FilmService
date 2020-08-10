<?php

namespace App\Providers;
use App\User;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //compose all the views....
        view()->composer('*', function ($view) 
        {
            if (Auth::check()){

            $user = User::find(Auth::id());

            //...with this variable
            $view->with('user', $user ); 

        }   
    });  
         Schema::defaultStringLength(191);
    }
}
