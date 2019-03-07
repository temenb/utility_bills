<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

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
class Meter extends Eloquent
{
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
