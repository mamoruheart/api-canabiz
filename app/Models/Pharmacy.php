<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Pharmacy
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $notes
 * @property bool $delivery
 * @property string|null $city
 * @property string|null $street
 * @property string|null $map
 * @property bool $in_db
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Pharmacy newModelQuery()
 * @method static Builder|Pharmacy newQuery()
 * @method static Builder|Pharmacy query()
 * @method static Builder|Pharmacy whereCity($value)
 * @method static Builder|Pharmacy whereCreatedAt($value)
 * @method static Builder|Pharmacy whereDelivery($value)
 * @method static Builder|Pharmacy whereId($value)
 * @method static Builder|Pharmacy whereInDb($value)
 * @method static Builder|Pharmacy whereMap($value)
 * @method static Builder|Pharmacy whereName($value)
 * @method static Builder|Pharmacy whereNotes($value)
 * @method static Builder|Pharmacy whereStreet($value)
 * @method static Builder|Pharmacy whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Pharmacy extends Model
{
    protected $table = 'pharmacies';

    protected $fillable = [
        'name',
        'notes',
        'delivery',
        'city',
        'street',
        'map',
        'in_db'
    ];

    protected $casts = [
        'delivery' => 'boolean',
        'in_db' => 'boolean',
    ];
}
