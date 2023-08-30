<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property int $id
 * @property int $update_id
 * @property int $media_group_id
 * @property string $file_id
 * @property string $file_unique_id
 * @property int $file_size
 * @property int $width
 * @property int $height
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class TgMessagePhoto extends Model
{
    use CrudTrait;
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
