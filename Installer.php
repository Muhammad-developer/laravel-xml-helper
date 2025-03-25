<?php

namespace Larataj\XmlHelpers;

class Installer
{
    public static function postInstall()
    {
        echo "\n\e[32m✔ larataj/xml-helpers установлен успешно!\e[0m\n";
        echo "→ XML поддержка активна через response()->xml() и ResponseHelper.\n";
        echo "→ JSON API ответы доступны через Larataj\\XmlHelpers\\Response\\ApiResponse.\n";
        echo "→ Пример: return ApiResponse::success(['message' => 'OK']);\n";
        echo "→ Документация: https://github.com/Muhammad-developer/laravel-xml-helper\n\n";
    }
}