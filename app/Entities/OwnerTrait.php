<?php

namespace App\Entities;

use Auth;

trait OwnerTrait
{
    protected static function bootOwnerTrait() {
        self::creating(function($model) {
            $model->owner()->associate(Auth::user());
            if (!$model->getAttributeFromArray('owner_id')) {
                $model->owner()->associate(Auth::user());
            }
        });
    }

    function owner() {
        return $this->belongsTo(User::class);
    }
}
