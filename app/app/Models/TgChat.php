<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property int $id
 * @property int $tg_id
 * @property string|null $title
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\TgUser[] $users
 * @property int|null $users_count
 */
class TgChat extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_TG_ID = 'tg_id',
        ATTR_TITLE = 'title',
        ATTR_TYPE = 'type',
        ATTR_CREATED_AT = 'created_at',
        ATTR_UPDATED_AT = 'updated_at';

    public const
        TYPE_PRIVATE = 'private',
        TYPE_SUPERGROUP = 'supergroup';

    protected $fillable = [
        self::ATTR_ID,
        self::ATTR_TG_ID,
        self::ATTR_TITLE,
        self::ATTR_TYPE,
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(TgUser::class, (new TgChatUser)->getTable());
    }
}
