<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
        //
        Validator::extend('valid_promotional_price', function ($attribute, $value, $parameters, $validator) {
            // Ensure promotional_price is required and less than the price
            $price = $validator->getData()['price'];

            return !empty($value) && $value < $price;
        });

        Validator::replacer('valid_promotional_price', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Phải nhỏ hơn giá.');
        });

        Schema::defaultStringLength(191);
    }
}
