<?php

namespace Larataj\XmlHelpers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

/**
 * Helpers Service Provider
 *
 * Registers XML and JSON helper macros for Laravel
 *
 * @package Larataj\XmlHelpers
 */
class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Register services
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services
     */
    public function boot(ResponseFactory $factory): void
    {
        // XML response macro
        $factory->macro('xml', function ($data, $status = 200, array $headers = [], $rootElement = 'response') {
            return ResponseHelper::xml($data, $status, $headers, $rootElement);
        });

        // XML builder macro
        $factory->macro('xmlBuilder', function ($rootElement = 'root', array $attributes = []) {
            return ResponseHelper::builder($rootElement, $attributes);
        });
    }
}