<?php

namespace App\Models\Entities;

use Auth;

trait OwnerTrait
{
    protected static function bootOwnerTrait() {
        self::creating(function($model) {
            if (!$model->getAttributeFromArray('owner_id')) {
                $model->owner()->associate(Auth::user());
            }
        });
    }

    function owner() {
        return $this->belongsTo(User::class);
    }
}
