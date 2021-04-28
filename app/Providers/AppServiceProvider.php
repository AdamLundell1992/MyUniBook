<?php

namespace App\Providers;

use http\Message;
use Illuminate\Support\ServiceProvider;

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
        \Validator::extend('email_domain', function($attribute, $value, $parameters, $validator) {
            $allowedEmailDomains = ['unimail.hud.ac.uk'];
            $messages = array(
                'required' => 'The :attribute field is required.',
            );
            if (!$allowedEmailDomains ){
                $messages;
            }
            return in_array( explode('@', $parameters[0])[1] , $allowedEmailDomains );
        });
    }
}



