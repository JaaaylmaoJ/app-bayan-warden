<?php

namespace App\Http\Middleware\Custom;

use Closure;
use App\Models\TgChat;
use App\Models\TgMessage;
use App\Models\TgChatUser;
use Illuminate\Http\Request;
use App\Models\TgUnhandledUpdate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\Chat\Repository\TgChatRepository;
use App\Services\User\Repository\TgUserRepositoryInterface;
use App\Services\Update\Repository\TelegramUpdateRepositoryInterface;

class CreateTgUser
{
    public function __construct(
        private TelegramUpdateRepositoryInterface $messageRepository,
        private TgUserRepositoryInterface $userRepository,
        private TgChatRepository $chatRepository,
    ) {
    }

    public function handle(Request $request, Closure $next)
    {
        $data = $request->all();

        $message = $this->messageRepository->findOne([TgMessage::ATTR_UPDATE_ID => $data['update_id']]);
        $message && DB::transaction(function() use ($message, $data) {
            $user = $this->userRepository->createFromMessage($message);
            $chat = $this->chatRepository->createFromMessage($message);

            $user->load(['chatUserLinks']);
            $hasChat = $user->chatUserLinks->contains(function(TgChatUser $link) use ($user, $chat, $message) {
                return $link->user_id == $user->id
                    &&  $link->chat_id == $chat->id
                    &&  $link->author_signature == $message->author_signature;
            });

            if(!$hasChat) {
                $user->chats()->save($chat, [TgChatUser::ATTR_AUTHOR_SIGNATURE => $message->author_signature]);
            }
        });

        return $next($request);
    }
}
