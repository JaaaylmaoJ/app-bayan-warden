<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Illuminate\Http\Request;
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
        $this->updateRepository->create($data);

        return $next($request);
    }
}