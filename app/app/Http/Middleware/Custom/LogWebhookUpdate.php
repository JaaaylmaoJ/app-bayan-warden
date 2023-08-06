<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Update\Repository\TelegramUpdateRepositoryInterface;

class LogWebhookUpdate
{
    public function __construct(private TelegramUpdateRepositoryInterface $updateRepository)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        $data = $request->all();

        try {
            $this->updateRepository->create($data);
        } catch(Exception $e) {
            Log::debug(json_encode($data, JSON_UNESCAPED_UNICODE), [__METHOD__]);
            throw $e;
        }



        return $next($request);
    }
}