<?php

namespace App\Services\Chat\Repository;

use Exception;
use App\Models\TgChat;
use App\Models\TgUser;
use App\Models\TgMessage;
use Illuminate\Support\Collection;
use romanzipp\ModelDoc\Exceptions\InvalidModelException;

class TgChatRepository implements TgChatRepositoryInterface
{
    public function find(array $filter, bool $first = false): null|TgChat|Collection
    {
        $query = TgChat::where($filter);
        return $first
            ? $query->first()
            : $query->get();
    }

    public function createFromMessage(TgMessage $message): TgChat
    {
        if(!$chat = $this->find([TgChat::ATTR_TG_ID => $message->chat_id], true)) {
            $chat = new TgChat([
                TgChat::ATTR_TG_ID => $message->chat_id,
                TgChat::ATTR_TYPE  => $message->message_body['chat']['type'],
                TgChat::ATTR_TITLE => match ($message->message_body['chat']['type']) {
                    TgChat::TYPE_PRIVATE    => $message->message_body['chat']['username'],
                    TgChat::TYPE_SUPERGROUP => $message->message_body['chat']['title'],
                    default                 => $message->message_body['chat']['title'] ?? null
                },
            ]);

            $chat->save() || throw new Exception(sprintf("Unable to save chat model %s. \n %s",
                    $chat->tg_id,
                    json_encode($message->message_body, JSON_UNESCAPED_UNICODE))
            );
        } else {
            $chat->update([
                TgChat::ATTR_TYPE  => $message->message_body['chat']['type'],
                TgChat::ATTR_TITLE  => match ($message->message_body['chat']['type']) {
                    TgChat::TYPE_PRIVATE    => $message->message_body['chat']['username'],
                    TgChat::TYPE_SUPERGROUP => $message->message_body['chat']['title'],
                    default                 => $message->message_body['chat']['title'] ?? null
                },
            ]);
        }

        return $chat;
    }
}