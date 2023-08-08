<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property int $id
 * @property int $tg_id
 * @property string $username
 * @property string|null $first_name
 * @property string|null $last_name
 * @property bool $is_bot
 * @property string|null $local_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\TgChat[] $chats
 * @property int|null $chats_count
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\TgChatUser[] $chatUserLinks
 * @property int|null $chat_user_links_count
 */
class TgUser extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_TG_ID = 'tg_id',
        ATTR_USERNAME = 'username',
        ATTR_IS_BOT = 'is_bot',
        ATTR_FIRST_NAME = 'first_name',
        ATTR_LAST_NAME = 'last_name',
        ATTR_LOCAL_NAME = 'local_name',
        ATTR_UPDATED_AT = 'updated_at',
        ATTR_CREATED_AT = 'created_at';

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_TG_ID,
        self::ATTR_USERNAME,
        self::ATTR_IS_BOT,
        self::ATTR_FIRST_NAME,
        self::ATTR_LAST_NAME,
        self::ATTR_LOCAL_NAME,
    ];

    public function chats(): BelongsToMany
    {
        return $this->belongsToMany(
            TgChat::class,
            (new TgChatUser)->getTable(),
            TgChatUser::ATTR_USER_ID,
            TgChatUser::ATTR_CHAT_ID,
        )/*->withPivot(TgChatUser::ATTR_USER_ALIAS)*/;
    }

    public function chatUserLinks(): HasMany
    {
        return $this->hasMany(TgChatUser::class,
            TgChatUser::ATTR_USER_ID,
            self::ATTR_ID,
        );
    }
}
