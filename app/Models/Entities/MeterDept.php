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
 * Class Account
 * 
 * @property int $id
 * @property int $service_id
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models\Entities
 */
class MeterDept extends Model
{
    use SoftDeletes, OwnerTrait, Enabled;

	protected $casts = [
		'service_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'service_id',
		'value',
	];

//    function organization() {
//        return $this->belongsTo(Organization::class);
//    }
}