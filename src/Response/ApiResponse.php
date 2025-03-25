<?php

namespace Larataj\XmlHelpers\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Хелпер для формирования стандартизированных JSON API-ответов.
 */
class ApiResponse
{
    /**
     * Успешный JSON-ответ.
     *
     * @param mixed $data Данные для возврата.
     * @param int $status HTTP-статус (по умолчанию 200).
     * @return JsonResponse
     */
    public static function success($data = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'ok' => true,
            'content' => $data,
        ], $status);
    }

    /**
     * Ответ 201 Created.
     *
     * @param mixed $data Данные ресурса.
     * @param string $message Сообщение.
     * @return JsonResponse
     */
    public static function created($data = [], string $message = 'Resource created successfully.'): JsonResponse
    {
        return self::success(['message' => $message, 'data' => $data], 201);
    }

    /**
     * Ответ при удалении ресурса.
     *
     * @param string $message Сообщение.
     * @return JsonResponse
     */
    public static function deleted(string $message = 'Resource deleted successfully.'): JsonResponse
    {
        return self::success(['message' => $message], 200);
    }

    /**
     * Ответ без контента (204 No Content).
     *
     * @return JsonResponse
     */
    public static function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * Ошибка валидации или бизнес-логики.
     *
     * @param array|string $errors Ошибки (массив или строка).
     * @param int $status HTTP-статус (по умолчанию 422).
     * @return JsonResponse
     */
    public static function error(array|string $errors = [], int $status = 422): JsonResponse
    {
        return response()->json([
            'ok' => false,
            'content' => [
                'errors' => is_array($errors) ? $errors : [$errors],
            ],
        ], $status);
    }

    /**
     * Ошибка 401 Unauthorized.
     *
     * @param string $message Сообщение.
     * @return JsonResponse
     */
    public static function unauthorized(string $message = 'Unauthorized.'): JsonResponse
    {
        return self::error($message, 401);
    }

    /**
     * Ошибка 403 Forbidden.
     *
     * @param string $message Сообщение.
     * @return JsonResponse
     */
    public static function forbidden(string $message = 'Forbidden.'): JsonResponse
    {
        return self::error($message, 403);
    }

    /**
     * Ошибка 404 Not Found.
     *
     * @param string $message Сообщение.
     * @return JsonResponse
     */
    public static function notFound(string $message = 'Resource not found.'): JsonResponse
    {
        return self::error($message, 404);
    }

    /**
     * Ошибка сервера 500.
     *
     * @param string $message Сообщение.
     * @return JsonResponse
     */
    public static function serverError(string $message = 'Server error.'): JsonResponse
    {
        return self::error($message, 500);
    }

    /**
     * Ответ с пагинацией.
     *
     * @param LengthAwarePaginator $paginator Экземпляр пагинатора.
     * @param string|null $resource Resource-класс (опционально).
     * @param int $status HTTP-статус.
     * @return JsonResponse
     */
    public static function paginated(LengthAwarePaginator $paginator, $resource = null, int $status = 200): JsonResponse
    {
        $items = $resource ? $resource::collection($paginator->items()) : $paginator->items();

        return response()->json([
            'ok' => true,
            'content' => [
                'data' => $items,
                'pagination' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page'    => $paginator->lastPage(),
                    'per_page'     => $paginator->perPage(),
                    'total'        => $paginator->total(),
                ],
            ],
        ], $status);
    }
}
