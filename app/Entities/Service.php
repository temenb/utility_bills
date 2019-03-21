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
 * Class Service
 * 
 * @property int $id
 * @property string $name
 * @property int $value
 * @property int $organization_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Entities
 */
class Service extends Model implements Transformable
{
    use TransformableTrait;

    protected $casts = [
		'value' => 'int',
		'organization_id' => 'int'
	];

	protected $fillable = [
		'name',
		'value',
		'organization_id',
        'creator_id',
	];

	function organization() {
        return $this->belongsTo(Organization::class);
    }

    function meters() {
        return $this->hasMany(Meter::class);
    }

    function creator() {
        return $this->belongsTo(User::class);
    }
}
