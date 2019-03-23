<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, OwnerTrait;

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

    function accounts() {
        return $this->hasMany(Account::class, 'owner_id');
    }

    function services() {
        return $this->hasMany(Service::class, 'owner_id');
    }

    function organizations() {
        return $this->hasMany(Organization::class, 'owner_id');
    }

    function meterValues() {
        return $this->hasMany(MeterValue::class, 'owner_id');
    }

    function serviceValues() {
        return $this->hasMany(ServiceValue::class, 'owner_id');
    }

    function meters() {
        return $this->hasMany(Meter::class, 'owner_id');
    }
}