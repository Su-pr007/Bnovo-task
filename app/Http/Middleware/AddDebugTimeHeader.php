<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddDebugTimeHeader
{
    public function handle(Request $request, Closure $next): mixed
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        // Вычисляем время выполнения
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000; // Время в миллисекундах

        // Считаем память после выполнения приложения
        $endMemory = memory_get_usage();
        $memoryUsage = $endMemory - $startMemory; // Затраты памяти за время обработки запроса

        $response->headers->set('X-Debug-Time', round($executionTime, 2) . ' ms');
        $response->headers->set('X-Debug-Memory', round($memoryUsage / 1024, 2) . ' KB'); // Конвертируем в КБ

        return $response;
    }
}