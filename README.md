# Laravel XML & JSON Helpers

**English version** | [Русская версия](#русская-версия)

---

## English Version

**Laravel XML & JSON Helpers** is a powerful, lightweight, and easy-to-use library for Laravel that helps you:

- Convert arrays to XML with ease
- Return XML responses in Laravel controllers
- Generate standardized JSON API responses (success, errors, pagination, and more)
- Work with XML and JSON seamlessly

### Features

✅ **Simple XML Conversion** - Convert arrays to XML in one line
✅ **Lightweight** - Minimal dependencies, optimized for performance
✅ **Easy Integration** - Works seamlessly with Laravel 5.5+
✅ **Standardized API Responses** - Build consistent JSON responses
✅ **Pagination Support** - Easy pagination for API resources
✅ **Multiple HTTP Status Codes** - Handle 200, 201, 204, 401, 403, 404, 500 and more
✅ **Framework Auto-discovery** - Automatic registration with Laravel 5.5+

### Installation

Install the package via Composer:

```bash
composer require larataj/xml-helpers
```

Laravel will automatically register the service provider thanks to **package auto-discovery**.
If you're using Laravel below 5.5, add it manually:

```php
// config/app.php
'providers' => [
    Larataj\XmlHelpers\HelpersServiceProvider::class,
],
```

---

### XML: Usage Guide

#### 1. Convert Array to XML

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

**Output:**
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

#### 2. Return XML Response in Laravel

```php
use Larataj\XmlHelpers\ResponseHelper;

return ResponseHelper::xml([
    'status' => 'success',
    'message' => 'Data processed successfully',
    'data' => ['id' => 123, 'name' => 'John Doe'],
]);
```

---

#### 3. Using the `response()->xml()` Macro

```php
return response()->xml([
    'status' => 'success',
    'data' => ['id' => 123, 'name' => 'John Doe'],
]);
```

---

### JSON API: Using `ApiResponse`

This library includes a convenient helper for generating standardized JSON responses.

```php
use Larataj\XmlHelpers\Response\ApiResponse;
```

#### Success Response

```php
return ApiResponse::success(['message' => 'OK']);
```

#### Created Response (201)

```php
return ApiResponse::created($user);
```

#### Delete Resource

```php
return ApiResponse::deleted();
```

#### Error Responses

```php
return ApiResponse::error(['email' => 'Email is already taken']);
return ApiResponse::error('An error occurred');
```

#### Pagination

```php
return ApiResponse::paginated($users, UserResource::class);
```

#### Ready-to-use HTTP Status Codes

```php
ApiResponse::unauthorized(); // 401
ApiResponse::forbidden();    // 403
ApiResponse::notFound();     // 404
ApiResponse::serverError();  // 500
ApiResponse::noContent();    // 204
```

### Example Routes for Testing

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

## Advanced Usage

### Using XmlBuilder for Complex XML

The `XmlBuilder` class provides a fluent interface for building complex XML documents:

```php
use Larataj\XmlHelpers\XmlBuilder;

$xml = new XmlBuilder('catalog', ['id' => '1']);

$xml->addChild('product', [
    'name' => 'Widget',
    'price' => '19.99',
    'stock' => '100'
])
->addChild('category', 'Electronics')
->addCData('description', 'A high-quality widget for your needs')
->addComment('Add more products as needed')
->addChild('tags', ['tag1' => 'new', 'tag2' => 'popular']);

echo $xml->toString(true); // true = formatted output
```

### Parsing XML with XmlParser

Parse and query XML documents easily:

```php
use Larataj\XmlHelpers\XmlParser;

// Parse XML string
$parser = new XmlParser('<root><item><name>Test</name></item></root>');

// Convert to array
$array = $parser->toArray();

// Query using XPath
$items = $parser->query('//item');

// Get single element
$firstItem = $parser->queryOne('//item[1]');

// Check if element exists
if ($parser->has('//item[@id="5"]')) {
    echo 'Item with id=5 found';
}

// Get pretty-printed XML
echo $parser->prettyPrint();
```

### Using Response Macros

You can also use convenient response macros:

```php
// Simple XML response
return response()->xml([
    'status' => 'success',
    'message' => 'Operation completed'
]);

// Using XML builder
$builder = response()->xmlBuilder('api-response', ['version' => '1.0']);
$builder->addChild('status', 'success')
        ->addChild('timestamp', now()->toIso8601String());

return response()->xml($builder->getXml()->asXML());
```

---

## Requirements

- PHP 7.4 or higher
- Laravel 5.5 or higher

---

## License

This package is licensed under the [MIT License](https://opensource.org/licenses/MIT).

**Author:** [Muhammad Vafoev](mailto:muhammadjonvafoev@gmail.com)

---

## Contributing

We welcome contributions! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for guidelines.

---

---

## Русская версия

**Laravel XML & JSON Helpers**

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

## Расширенное использование

### Использование XmlBuilder для сложного XML

Класс `XmlBuilder` предоставляет удобный интерфейс для построения сложных XML-документов:

```php
use Larataj\XmlHelpers\XmlBuilder;

$xml = new XmlBuilder('каталог', ['id' => '1']);

$xml->addChild('товар', [
    'название' => 'Виджет',
    'цена' => '19.99',
    'количество' => '100'
])
->addChild('категория', 'Электроника')
->addCData('описание', 'Высокачественный виджет для ваших нужд')
->addComment('Добавьте больше товаров по необходимости')
->addChild('теги', ['тег1' => 'новое', 'тег2' => 'популярное']);

echo $xml->toString(true); // true = форматированный вывод
```

### Парсинг XML с XmlParser

Легко парсьте и запрашивайте XML-документы:

```php
use Larataj\XmlHelpers\XmlParser;

// Парсинг XML-строки
$parser = new XmlParser('<root><item><name>Тест</name></item></root>');

// Преобразование в массив
$array = $parser->toArray();

// Запрос с помощью XPath
$items = $parser->query('//item');

// Получение одного элемента
$firstItem = $parser->queryOne('//item[1]');

// Проверка существования элемента
if ($parser->has('//item[@id="5"]')) {
    echo 'Товар с id=5 найден';
}

// Красиво отформатированный XML
echo $parser->prettyPrint();
```

### Использование макросов Response

Вы также можете использовать удобные макросы:

```php
// Простой XML-ответ
return response()->xml([
    'status' => 'success',
    'message' => 'Операция выполнена'
]);

// Использование XML builder
$builder = response()->xmlBuilder('api-response', ['version' => '1.0']);
$builder->addChild('status', 'success')
        ->addChild('timestamp', now()->toIso8601String());

return response()->xml($builder->getXml()->asXML());
```

---

## Требования

- PHP 7.4 и выше
- Laravel 5.5 и выше

---

## Лицензия

Пакет распространяется под лицензией [MIT](https://opensource.org/licenses/MIT).

Автор: [Muhammad Vafoev](mailto:muhammadjonvafoev@gmail.com)

---

## Содействие

Мы приветствуем вклад! Пожалуйста, ознакомьтесь с [CONTRIBUTING.md](CONTRIBUTING.md) для получения рекомендаций.

---