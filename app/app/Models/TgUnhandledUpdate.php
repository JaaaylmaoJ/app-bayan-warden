<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property int $id
 * @property int|null $update_id
 * @property array $payload
 * @property bool $is_handled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class TgUnhandledUpdate extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_UPDATE_ID = 'update_id',
        ATTR_PAYLOAD = 'payload',
        ATTR_HANDLED_AT = 'handled_at',
        ATTR_UPDATED_AT = 'updated_at',
        ATTR_CREATED_AT = 'created_at';

    protected $fillable = [
        self::ATTR_UPDATE_ID,
        self::ATTR_PAYLOAD,
        self::ATTR_UPDATED_AT,
        self::ATTR_HANDLED_AT,
    ];

    protected $casts = [
        self::ATTR_PAYLOAD => 'array'
    ];
}
