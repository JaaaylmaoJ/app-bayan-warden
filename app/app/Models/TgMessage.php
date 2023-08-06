<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int     $id
 * @property int     $update_id
 * @property int     $message_id
 * @property int     $chat_id
 * @property int     $from_id
 * @property string  $text
 * @property string  $author_signature
 * @property int     $sender_chat_id
 * @property string  $caption
 * @property boolean $has_photo
 * @property boolean $has_video
 * @property boolean $is_forwarded
 * @property string  $date
 * @property array   $message_body
 * @property string  $updated_at
 * @property string  $created_at
 */
class TgMessage extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_UPDATE_ID = 'update_id',
        ATTR_MESSAGE_ID = 'message_id',
        ATTR_CHAT_ID = 'chat_id',
        ATTR_FROM_ID = 'from_id',
        ATTR_TEXT = 'text',
        ATTR_AUTHOR_SIGNATURE = 'author_signature',
        ATTR_SENDER_CHAT_ID = 'sender_chat_id',
        ATTR_CAPTION = 'caption',
        ATTR_HAS_PHOTO = 'has_photo',
        ATTR_HAS_VIDEO = 'has_video',
        ATTR_IS_FORWARDED = 'is_forwarded',
        ATTR_DATE = 'date',
        ATTR_MESSAGE_BODY = 'message_body',
        ATTR_UPDATED_AT = 'updated_at',
        ATTR_CREATED_AT = 'created_at';

    protected $fillable = [
        self::ATTR_UPDATE_ID,
        self::ATTR_MESSAGE_ID,
        self::ATTR_CHAT_ID,
        self::ATTR_FROM_ID,
        self::ATTR_FROM_ID,
        self::ATTR_TEXT,
        self::ATTR_AUTHOR_SIGNATURE,
        self::ATTR_SENDER_CHAT_ID,
        self::ATTR_CAPTION,
        self::ATTR_HAS_PHOTO,
        self::ATTR_HAS_VIDEO,
        self::ATTR_IS_FORWARDED,
        self::ATTR_MESSAGE_BODY,
        self::ATTR_DATE,
        self::ATTR_UPDATED_AT,
    ];

    protected $casts = [
        self::ATTR_MESSAGE_BODY => 'array',
    ];
}
