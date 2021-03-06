<?php

namespace App\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Entities\Traits\OwnerTrait;
use App\Models\Entities\Traits\Active\Enabled;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, OwnerTrait, Enabled;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    function accounts() {
//        return $this->hasMany(Account::class, 'owner_id');
//    }
//
//    function services() {
//        return $this->hasMany(Service::class, 'owner_id');
//    }

    function organizations() {
        return $this->hasMany(Organization::class, 'owner_id');
    }
//
//    function meterDatas() {
//        return $this->hasMany(MeterData::class, 'owner_id');
//    }
//
//    function meters() {
//        return $this->hasMany(Meter::class, 'owner_id');
//    }
}