
---

# Laravel XML Helpers

**Laravel XML Helpers** — это библиотека, которая позволяет легко преобразовывать массивы в XML и возвращать HTTP-ответы в формате XML в Laravel.

---

## Установка

Установите пакет через Composer:

```bash
composer require larataj/laravel-xml-helpers
```

Если вы используете Laravel 5.5 или выше, пакет автоматически зарегистрируется благодаря **автодетекту провайдеров**. Если вы используете более старую версию Laravel, добавьте сервис-провайдер вручную в `config/app.php`:

```php
'providers' => [
    ...
    Helpers\XmlHelpers\HelpersServiceProvider::class,
],
```

---

## Использование

### 1. Преобразование массива в XML

Вы можете использовать метод `ResponseHelper::arrayToXml` для преобразования PHP-массива в строку XML.

```php
use Helpers\XmlHelpers\ResponseHelper;

$array = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'roles' => [
        'admin',
        'editor',
    ],
];

$xml = ResponseHelper::arrayToXml($array);

echo $xml;
```

**Результат:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<response>
  <name>John Doe</name>
  <email>john.doe@example.com</email>
  <roles>
    <item>admin</item>
    <item>editor</item>
  </roles>
</response>
```

---

### 2. Возврат HTTP-ответа в формате XML

С помощью метода `ResponseHelper::xml` вы можете вернуть XML-ответ в Laravel:

```php
use Helpers\XmlHelpers\ResponseHelper;

return ResponseHelper::xml([
    'status' => 'success',
    'message' => 'Данные успешно обработаны',
    'data' => [
        'id' => 123,
        'name' => 'John Doe',
    ],
]);
```

**Результат в браузере (HTTP-ответ):**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<response>
  <status>success</status>
  <message>Данные успешно обработаны</message>
  <data>
    <id>123</id>
    <name>John Doe</name>
  </data>
</response>
```

---

### 3. Использование макроса `response()->xml()`

Пакет добавляет макрос в фабрику ответов Laravel, что позволяет возвращать XML напрямую:

```php
return response()->xml([
    'status' => 'success',
    'message' => 'Данные обработаны',
    'data' => [
        'id' => 123,
        'name' => 'John Doe',
    ],
]);
```

**Результат:**
```xml
<?xml version="1.0" encoding="UTF-8"?>
<response>
  <status>success</status>
  <message>Данные обработаны</message>
  <data>
    <id>123</id>
    <name>John Doe</name>
  </data>
</response>
```

---

## Тестирование

Чтобы протестировать преобразование массива в XML, напишите код в одном из маршрутов или контроллеров:

```php
Route::get('/test-xml', function () {
    return response()->xml([
        'name' => 'Laravel',
        'version' => '10.x',
        'features' => [
            'fast',
            'secure',
            'elegant'
        ]
    ]);
});
```

Затем откройте `/test-xml` в браузере, чтобы увидеть результат.

---

## Лицензия

Этот пакет распространяется под лицензией [MIT](vendor/composer/LICENSE).

---