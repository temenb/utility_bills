<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Entities\Traits\OwnerTrait;
use App\Models\Entities\Traits\Active\Enabled;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $name
 * @property int $value
 * @property int $organization_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
use Illuminate\Database\Eloquent\SoftDeletes;
 *
 * @package App\Models\Entities
 */
class Service extends Model
{
    use SoftDeletes, OwnerTrait, Enabled;

    protected $casts = [
		'organization_id' => 'int'
	];

	protected $fillable = [
		'name',
		'organization_id',
	];

	function organization() {
        return $this->belongsTo(Organization::class);
    }

    function meters() {
        return $this->hasMany(Meter::class);
    }

    function serviceValues() {
        return $this->hasMany(ServiceValue::class);
    }
}
