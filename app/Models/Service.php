<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $name
 * @property int $value
 * @property int $organization_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Service extends Eloquent
{
	protected $casts = [
		'value' => 'int',
		'organization_id' => 'int'
	];

	protected $fillable = [
		'name',
		'value',
		'organization_id'
	];

	function organization() {
        return $this->hasOne('App\Models\Organization');
    }

    function meters() {
        return $this->hasMany('App\Models\Meter');
    }

    function accounts() {
        return $this->hasMany('App\Models\Account');
    }
}
