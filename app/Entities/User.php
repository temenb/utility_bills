<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        return $this->hasMany(Account::class, 'creator_id');
    }

    function services() {
        return $this->hasMany(Service::class, 'creator_id');
    }

    function organizations() {
        return $this->hasMany(Organization::class, 'creator_id');
    }

    function meterValues() {
        return $this->hasMany(MeterValue::class, 'creator_id');
    }

    function meters() {
        return $this->hasMany(Meter::class, 'creator_id');
    }
}