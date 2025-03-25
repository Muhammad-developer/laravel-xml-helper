# Laravel XML & JSON Helpers

Laravel XML & JSON Helpers** — это библиотека, которая позволяет легко:

- Преобразовывать массивы в XML
- Возвращать XML-ответы в Laravel
- Формировать стандартизированные JSON API-ответы (успешные, ошибки, пагинация и др.)

---

## Установка

Установите пакет через Composer:

```bash
composer require larataj/xml-helpers
```

Laravel автоматически зарегистрирует провайдер благодаря **автодетекту**.  
Если вы используете Laravel ниже 5.5, добавьте вручную:

```php
// config/app.php
'providers' => [
    Larataj\XmlHelpers\HelpersServiceProvider::class,
],
```

---

## XML: Использование

### 1. Преобразование массива в XML

```php
use Larataj\XmlHelpers\ResponseHelper;

$array = [
    'name' => 'John Doe',
    'email' => 'john.doe@example.com',
    'roles' => ['admin', 'editor'],
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

### 2. Возврат XML-ответа в Laravel

```php
use Larataj\XmlHelpers\ResponseHelper;

return ResponseHelper::xml([
    'status' => 'success',
    'message' => 'Данные обработаны',
    'data' => ['id' => 123, 'name' => 'John Doe'],
]);
```

---

### 3. Использование макроса `response()->xml()`

```php
return response()->xml([
    'status' => 'success',
    'data' => ['id' => 123, 'name' => 'John Doe'],
]);
```

---

## JSON API: Использование `ApiResponse`

Библиотека включает удобный хелпер для формирования стандартизированных JSON-ответов.

```php
use Larataj\XmlHelpers\Response\ApiResponse;
```

---

### Успешный ответ

```php
return ApiResponse::success(['message' => 'OK']);
```

### Ответ `201 Created`

```php
return ApiResponse::created($user);
```

### Удаление ресурса

```php
return ApiResponse::deleted();
```

### Ошибки

```php
return ApiResponse::error(['email' => 'Email уже занят']);
return ApiResponse::error('Произошла ошибка');
```

### Пагинация

```php
return ApiResponse::paginated($users, UserResource::class);
```

---

### Готовые статусы:

```php
ApiResponse::unauthorized(); // 401
ApiResponse::forbidden();    // 403
ApiResponse::notFound();     // 404
ApiResponse::serverError();  // 500
ApiResponse::noContent();    // 204
```

---

## Пример маршрута для теста

```php
Route::get('/test-xml', function () {
    return response()->xml([
        'name' => 'Laravel',
        'version' => '10.x',
        'features' => ['fast', 'secure', 'elegant']
    ]);
});

Route::get('/test-json', function () {
    return \Larataj\XmlHelpers\Response\ApiResponse::success([
        'framework' => 'Laravel',
        'version' => app()->version(),
    ]);
});
```

---

## Лицензия

Пакет распространяется под лицензией [MIT](https://opensource.org/licenses/MIT).

Автор: [Muhammad Vafoev](mailto:muhammadjonvafoev@gmail.com)

---