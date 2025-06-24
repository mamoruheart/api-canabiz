<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\StripTab
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $date
 * @property string|null $title
 * @property string|null $description
 * @property string|null $url
 * @property bool $is_old
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|StripTab newModelQuery()
 * @method static Builder|StripTab newQuery()
 * @method static Builder|StripTab query()
 * @method static Builder|StripTab whereCreatedAt($value)
 * @method static Builder|StripTab whereDate($value)
 * @method static Builder|StripTab whereDescription($value)
 * @method static Builder|StripTab whereId($value)
 * @method static Builder|StripTab whereIsOld($value)
 * @method static Builder|StripTab whereTitle($value)
 * @method static Builder|StripTab whereType($value)
 * @method static Builder|StripTab whereUpdatedAt($value)
 * @method static Builder|StripTab whereUrl($value)
 * @mixin Eloquent
 */
class StripTab extends Model
{
    protected $table = 'strip_tabs';

    protected $casts = [
        'is_old' => 'boolean'
    ];

    protected $fillable = [
        'type',
        'date',
        'title',
        'description',
        'url',
        'is_old'
    ];
}
