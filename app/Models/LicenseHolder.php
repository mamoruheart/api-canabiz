<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\LicenseHolder
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property bool $in_db
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|LicenseHolder newModelQuery()
 * @method static Builder|LicenseHolder newQuery()
 * @method static Builder|LicenseHolder query()
 * @method static Builder|LicenseHolder whereCreatedAt($value)
 * @method static Builder|LicenseHolder whereId($value)
 * @method static Builder|LicenseHolder whereInDb($value)
 * @method static Builder|LicenseHolder whereName($value)
 * @method static Builder|LicenseHolder whereType($value)
 * @method static Builder|LicenseHolder whereUpdatedAt($value)
 * @mixin Eloquent
 */
class LicenseHolder extends Model
{
    protected $table = 'license_holders';

    protected $casts = [
        'in_db' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'type',
        'in_db'
    ];
}
