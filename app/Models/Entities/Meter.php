<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Entities\Traits\OwnerTrait;
use App\Models\Entities\Traits\EnumType;
use App\Models\Entities\Traits\Active\Enabled;

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
 * @package App\Models\Entities
 */
class Meter extends Model
{
    use SoftDeletes, OwnerTrait, Enabled, EnumType;

    const ENUM_TYPE_MEASURING = 'measuring';
//    const ENUM_TYPE_HOURLY = 'hourly';
    const ENUM_TYPE_DAILY = 'daily';
    const ENUM_TYPE_WEEKLY = 'weekly';
    const ENUM_TYPE_MONTHLY = 'monthly';
    const ENUM_TYPE_ANNUALLY = 'annually';
    const ENUM_TYPE_QUARTERLY = 'quarterly';

	protected $casts = [
		'service_id' => 'int',
		'rate' => 'int'
	];

	protected $fillable = [
		'service_id',
		'name',
		'type',
		'rate',
	];

	private static $enumTypeValues = [];

//    function service() {
//        return $this->belongsTo(Service::class);
//    }

    function mData() {
        return $this->hasMany(MeterData::class);
    }

    function setTypeAttribute($type)
    {
        if (in_array($type, self::enumType())) {
            $this->attributes['type'] = $type;
        }
    }

    static function enumType() {
        return self::extractEnumType(self::$enumTypeValues);
    }

    function mDebts() {
        return $this->hasMany(MeterDebt::class);
    }
}

