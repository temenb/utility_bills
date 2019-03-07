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
 * Class Account
 * 
 * @property int $id
 * @property int $service_id
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Entities
 */
class Account extends Model implements Transformable
{
    use TransformableTrait;

	protected $casts = [
		'service_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'service_id',
		'value'
	];

    function organization() {
        return $this->belongsTo('App\Entities\Organization');
    }
}
