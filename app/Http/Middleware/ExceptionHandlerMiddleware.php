<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ExceptionHandlerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Exception $exception) {
            // Логирование исключения
            Log::error($exception);

            // Возвращаем ответ с ошибкой
            $statusCode = $this->getStatusCode($exception);
            $response = [
                'error' => true,
                'message' => $exception->getMessage(),
            ];

            return response()->json($response, $statusCode);
        }
    }

    protected function getStatusCode(Exception $exception): int
    {
        // Возвращаем статус код в зависимости от типа исключения
        // Можете настроить свою логику обработки разных типов исключений
        if ($exception instanceof \App\Exceptions\CustomException) {
            return 400; // Пример: Ошибка клиента
        }

        return 500; // Внутренняя ошибка сервера
    }
}
