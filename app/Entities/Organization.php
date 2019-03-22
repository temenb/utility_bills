<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
class Organization extends Model
{
    use SoftDeletes;

    protected $fillable = [
		'name',
        'owner_id',
	];

    function services() {
        return $this->hasMany(Service::class);
    }

    function accounts() {
        return $this->hasMany(Account::class);
    }

    function owner() {
        return $this->belongsTo(User::class);
    }
}
