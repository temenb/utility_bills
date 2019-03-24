<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 02 Mar 2019 04:18:08 +0000.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * 
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 *
 * @package App\Models\Entities
 */
class PasswordReset extends Model
{
    public $timestamps = false;

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'email',
		'token'
	];
}
