<?php

namespace LaravelHelpers/XmlHelpers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Регистрирует сервисы.
     */
    public function register(): void
    {
        //
    }

    /**
     * Выполняет загрузку сервиса.
     */
    public function boot(ResponseFactory $factory): void
    {
        $factory->macro('xml', function ($data, $status = 200, array $headers = [], $rootElement = '<response/>') {
            return ResponseHelper::xml($data, $status, $headers, $rootElement);
        });
    }
}