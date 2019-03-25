<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 06:26:30 +0000.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Entities\Traits\OwnerTrait;
use App\Models\Entities\Traits\Active\Enabled;

/**
 * Class MeterValue
 * 
 * @property int $id
 * @property int $meter_id
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models\Entities
 */
class MeterValue extends Model
{
    use SoftDeletes, OwnerTrait, Enabled;

    protected $casts = [
		'meter_id' => 'int',
		'value' => 'int'
	];

	protected $fillable = [
		'meter_id',
		'value',
        'owner_id',
	];

    function meter() {
        return $this->belongsTo(Meter::class);
    }

    function owner() {
        return $this->belongsTo(User::class);
    }
}
