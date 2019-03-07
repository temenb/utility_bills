<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 06:26:30 +0000.
 */

namespace App\Entities;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MeterValue
 * 
 * @property int $id
 * @property int $meter_id
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class MeterValue extends Eloquent
{
	protected $casts = [
		'meter_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'meter_id',
		'value'
	];

    function meter() {
        return $this->belongsTo('App\Models\Meter');
    }
}
