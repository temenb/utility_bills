<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Meter
 * 
 * @property int $id
 * @property int $service_id
 * @property string $type
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Entities
 */
class Meter extends Model
{
    use SoftDeletes;

    const ENUM_TYPE = [
        'FIXED' => 'fixed',
        'NOT_FIXED' => 'not_fixed',
    ];

	protected $casts = [
		'service_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'service_id',
		'type',
		'value',
        'owner_id',
	];

    function service() {
        return $this->belongsTo(Service::class);
    }

    function meterValues() {
        return $this->hasMany(MeterValue::class);
    }

    function owner() {
        return $this->belongsTo(User::class);
    }
}
