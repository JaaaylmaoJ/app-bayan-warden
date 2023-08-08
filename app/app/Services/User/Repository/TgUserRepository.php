<?php

namespace App\Services\User\Repository;

use App\Models\TgUser;
use App\Models\TgChat;
use App\Models\TgMessage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Services\Chat\Repository\TgChatRepositoryInterface;
use App\Services\Update\Repository\TelegramUpdateRepositoryInterface;

class TgUserRepository implements TgUserRepositoryInterface
{
    public function __construct(
        private TelegramUpdateRepositoryInterface $updateRepository,
        private TgChatRepositoryInterface $chatRepository,
    ) {
    }

    public function find(array $filter, bool $first = false): null|TgUser|Collection
    {
        $query = TgUser::where($filter);
        return $first
            ? $query->first()
            : $query->get();
    }

    public function createFromMessage(TgMessage $message): TgUser
    {
        if(!$tgUser = $this->find([TgUser::ATTR_TG_ID => $message->from_id], true)) {
            $tgUser = TgUser::create([
                TgUser::ATTR_TG_ID      => $message->from_id,
                TgUser::ATTR_USERNAME   => $message->message_body['from']['username'],
                TgUser::ATTR_IS_BOT     => $message->message_body['from']['is_bot'],
                TgUser::ATTR_FIRST_NAME => $message->message_body['from']['first_name'],
                TgUser::ATTR_LAST_NAME  => $message->message_body['from']['last_name'] ?? null,
            ]);
        } else {
            $tgUser->update([
                TgUser::ATTR_FIRST_NAME => $message->message_body['from']['first_name'],
                TgUser::ATTR_LAST_NAME  => $message->message_body['from']['last_name'] ?? null,
            ]);
        }

        return $tgUser;
    }
}