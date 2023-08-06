<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Models\TgUnhandledUpdate;
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
            Log::debug(implode("\n", [$e->getMessage(), json_encode($data, JSON_UNESCAPED_UNICODE)]), [__METHOD__]);
            (new TgUnhandledUpdate([
                TgUnhandledUpdate::ATTR_UPDATE_ID => $data['update_id'] ?? null,
                TgUnhandledUpdate::ATTR_PAYLOAD   => $data,
            ]))->save();
        }



        return $next($request);
    }
}