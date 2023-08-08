<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string|null $author_signature
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class TgChatUser extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_CHAT_ID = 'chat_id',
        ATTR_USER_ID = 'user_id',
        ATTR_AUTHOR_SIGNATURE = 'author_signature',
        ATTR_CREATED_AT = 'created_at',
        ATTR_UPDATED_AT = 'updated_at';


}
