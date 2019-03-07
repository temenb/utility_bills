<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

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
 * @package App\Models
 */
class Meter extends Model implements Transformable
{
    use TransformableTrait;

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
		'value'
	];

    function service() {
        return $this->belongsTo('App\Models\Service');
    }

    function meterValues() {
        return $this->hasMany('App\Models\MeterValue');
    }
}

