<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TgMessagePhoto extends Model
{
    use HasFactory;

    public const
        ATTR_ID = 'id',
        ATTR_UPDATE_ID = 'update_id',
        ATTR_MEDIA_GROUP_ID = 'media_group_id',
        ATTR_FILE_ID = 'file_id',
        ATTR_FILE_UNIQUE_ID = 'file_unique_id',
        ATTR_FILE_SIZE = 'file_size',
        ATTR_WIDTH = 'width',
        ATTR_HEIGHT = 'height',
        ATTR_UPDATED_AT = 'updated_at',
        ATTR_CREATED_AT = 'created_at';

    protected $fillable = [
        self::ATTR_UPDATE_ID,
        self::ATTR_MEDIA_GROUP_ID,
        self::ATTR_FILE_ID,
        self::ATTR_FILE_UNIQUE_ID,
        self::ATTR_FILE_SIZE,
        self::ATTR_WIDTH,
        self::ATTR_HEIGHT,
        self::ATTR_UPDATED_AT,
    ];
}
