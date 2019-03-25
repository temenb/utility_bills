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
 * Class Organization
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models\Entities
 */
class Organization extends Model
{
    use SoftDeletes, OwnerTrait, Enabled;

    protected $fillable = [
		'name',
	];

    function services() {
        return $this->hasMany(Service::class);
    }

    function aServices() {
        return $this->hasMany(Service::class)->where('active');
    }

    function accounts() {
        return $this->hasMany(Account::class);
    }
}
