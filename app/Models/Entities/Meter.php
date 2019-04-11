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
    const ENUM_TYPE_PERIOD = 'period';

	protected $casts = [
		'service_id' => 'int',
		'rate' => 'int',
		'disabled_months' => 'array',
	];

	protected $fillable = [
		'service_id',
		'name',
		'type',
		'rate',
	];

    function service() {
        return $this->belongsTo(Service::class);
    }

    function mData() {
        return $this->hasMany(MeterData::class);
    }

    function setTypeAttribute($type)
    {
        if (in_array($type, self::enumType())) {
            $this->attributes['type'] = $type;
        }
    }

    function setPeriod($period) {
        $enum = self::enumPeriod($period);
        if (is_array($enum)) {
            $key = array_search($period, $enum);
            if ($key > -1) {
                $this->setAttribute('period', $key);
            }
        } else {
            $this->setAttribute('period', $period);
        }
    }

    static function enumType($key = null) {
        static $enum = [];
        $enum = self::extractEnum($enum, 'ENUM_TYPE_');

        if ($key) {
            return isset($enum[$key]) ? $enum[$key] : null;
        }
        return $enum = self::extractEnum($enum, 'ENUM_TYPE_');
    }

    static function enumPeriod($key = null) {
        $enum = [
            '+1 hour' => 'hourly',
            '+1 day' => 'daily',
            '+1 week' => 'weekly',
            '+1 month' => 'monthly',
            '+3 month' => 'quarterly',
            '+1 year' => 'annually',
        ];

        if ($key) {
            return isset($enum[$key]) ? $enum[$key] : null;
        }
        return $enum;
    }

    function mDebts() {
        return $this->hasMany(MeterDebt::class);
    }
}

