<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TgUnhandledUpdate extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_UPDATE_ID = 'update_id',
        ATTR_PAYLOAD = 'payload',
        ATTR_IS_HANDLED = 'is_handled',
        ATTR_UPDATED_AT = 'updated_at',
        ATTR_CREATED_AT = 'created_at';

    protected $fillable = [
        self::ATTR_UPDATE_ID,
        self::ATTR_PAYLOAD,
        self::ATTR_UPDATED_AT,
        self::ATTR_IS_HANDLED,
    ];

    protected $casts = [
        self::ATTR_PAYLOAD => 'array'
    ];
}
