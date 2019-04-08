<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 06:26:30 +0000.
 */

namespace App\Models\Entities;

use App\Models\Entities\Traits\EnumType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Entities\Traits\OwnerTrait;
use App\Models\Entities\Traits\Active\Enabled;

/**
 * Class MeterData
 * 
 * @property int $id
 * @property int $meter_id
 * @property int $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models\Entities
 */
class MeterData extends Model
{
    use SoftDeletes, OwnerTrait, Enabled, EnumType;

    const ENUM_POSITION_PAST = 'past';
    const ENUM_POSITION_CURRENT = 'current';
    const ENUM_POSITION_FUTURE = 'future';

    protected $casts = [
		'meter_id' => 'int',
		'owner_id' => 'int',
		'value' => 'int',
		'charge_at' => 'datetime',
		'handled_at' => 'datetime',
	];

	protected $fillable = [
		'owner_id',
		'meter_id',
		'value',
		'position',
        'charge_at',
        'handled_at',
	];

    function meter() {
        return $this->belongsTo(Meter::class);
    }

    static function enumPosition() {
        static $enum = [];
        return $enum = self::extractEnum($enum, 'ENUM_POSITION_');
    }

//    function owner() {
//        return $this->belongsTo(User::class);
//    }
}
