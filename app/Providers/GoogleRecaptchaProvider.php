<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\GoogleRecaptcha;
use Illuminate\Support\Facades\Validator;

class GoogleRecaptchaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('google_recaptcha',new GoogleRecaptcha);
    }
}
