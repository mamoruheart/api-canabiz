<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Physician
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $institution
 * @property string|null $specialty
 * @property string|null $city
 * @property string|null $street
 * @property bool $in_db
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Physician newModelQuery()
 * @method static Builder|Physician newQuery()
 * @method static Builder|Physician query()
 * @method static Builder|Physician whereCity($value)
 * @method static Builder|Physician whereCreatedAt($value)
 * @method static Builder|Physician whereId($value)
 * @method static Builder|Physician whereInDb($value)
 * @method static Builder|Physician whereInstitution($value)
 * @method static Builder|Physician whereName($value)
 * @method static Builder|Physician whereSpecialty($value)
 * @method static Builder|Physician whereStreet($value)
 * @method static Builder|Physician whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Physician extends Model
{
    protected $table = 'physicians';

    protected $casts = [
        'in_db' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'institution',
        'specialty',
        'city',
        'street',
        'in_db'
    ];

}
