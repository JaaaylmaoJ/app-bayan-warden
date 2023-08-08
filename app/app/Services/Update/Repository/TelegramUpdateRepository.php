<?php

namespace App\Services\Update\Repository;

use App\Models\TgMessage;
use App\Models\TgMessagePhoto;
use App\Models\TgMessageVideo;
use Illuminate\Support\Facades\DB;

class TelegramUpdateRepository implements TelegramUpdateRepositoryInterface
{
    public function findOne($filter): ?TgMessage
    {
        $message = TgMessage::where($filter)->get()->first();
        return $message;
    }

    public function create(array $args): TgMessage
    {
        $message = $args['message'];
        $attr    = [
            TgMessage::ATTR_UPDATE_ID        => $args['update_id'],
            TgMessage::ATTR_MESSAGE_ID       => $message['message_id'],
            TgMessage::ATTR_CHAT_ID          => $message['chat']['id'],
            TgMessage::ATTR_FROM_ID          => $message['from']['id'],
            TgMessage::ATTR_TEXT             => $message['text'] ?? null,
            TgMessage::ATTR_AUTHOR_SIGNATURE => $message['author_signature'] ?? null,
            TgMessage::ATTR_SENDER_CHAT_ID   => $message['sender_chat']['id'] ?? null,
            TgMessage::ATTR_CAPTION          => $message['caption'] ?? null,
            TgMessage::ATTR_HAS_PHOTO        => isset($message['photo']),
            TgMessage::ATTR_HAS_VIDEO        => isset($message['video']),
            TgMessage::ATTR_IS_FORWARDED     => isset($message['forward_from_chat']),
            TgMessage::ATTR_DATE             => date(DATE_RFC3339, $message['date']),
            TgMessage::ATTR_MESSAGE_BODY     => $message,
        ];

        $model = new TgMessage($attr);

        return DB::transaction(function () use ($model) {
            $model->save();
            $model->has_photo && $this->savePhoto($model);
            $model->has_video && $this->saveVideo($model);

            return $model;
        });
    }

    private function savePhoto(TgMessage $model): array
    {
        $messageBody = $model->message_body;

        $models = array_map(fn($photo) => new TgMessagePhoto([
            TgMessagePhoto::ATTR_UPDATE_ID => $model->update_id,
            TgMessagePhoto::ATTR_MEDIA_GROUP_ID => $messageBody['media_group_id'],
            TgMessagePhoto::ATTR_FILE_ID => $photo['file_id'],
            TgMessagePhoto::ATTR_FILE_UNIQUE_ID => $photo['file_unique_id'],
            TgMessagePhoto::ATTR_FILE_SIZE => $photo['file_size'],
            TgMessagePhoto::ATTR_WIDTH => $photo['width'],
            TgMessagePhoto::ATTR_HEIGHT => $photo['height'],
        ]), $messageBody['photo']);

        array_walk($models, fn(TgMessagePhoto $p) => $p->save());

        return $models;
    }

    private function saveVideo(TgMessage $model): TgMessageVideo
    {
        $messageBody = $model->message_body;
        $video       = $model->message_body['video'];

        $video = new TgMessageVideo([
            TgMessageVideo::ATTR_UPDATE_ID      => $model->update_id,
            TgMessageVideo::ATTR_MEDIA_GROUP_ID => $messageBody['media_group_id'],
            TgMessageVideo::ATTR_FILE_NAME      => $video['file_name'],
            TgMessageVideo::ATTR_FILE_ID        => $video['file_id'],
            TgMessageVideo::ATTR_MIME_TYPE      => $video['mime_type'],
            TgMessageVideo::ATTR_DURATION       => $video['duration'],
            TgMessageVideo::ATTR_FILE_UNIQUE_ID => $video['file_unique_id'],
            TgMessageVideo::ATTR_FILE_SIZE      => $video['file_size'],
            TgMessageVideo::ATTR_THUMBNAIL      => $video['thumbnail'],
            TgMessageVideo::ATTR_THUMB          => $video['thumb'],
        ]);

        $video->save();

        return $video;
    }
}