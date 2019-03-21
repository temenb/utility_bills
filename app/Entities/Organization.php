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
 * Class Organization
 * 
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Entities
 */
class Organization extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
		'name',
        'creator_id',
	];

    function services() {
        return $this->hasMany(Service::class);
    }

    function accounts() {
        return $this->hasMany(Account::class);
    }

    function creator() {
        return $this->belongsTo(User::class);
    }
}
