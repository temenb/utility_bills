<?php

namespace App\Models\Entities\Traits;

use App\Models\Entities\User;
use Auth;

trait OwnerTrait
{
    protected static function bootOwnerTrait() {
        self::creating(function($model) {
            if (!$model->getAttributeFromArray(self::getOwnerColumn())) {
                $model->owner()->associate(Auth::user());
            }
        });
    }

    /**
     * Get the name of the "active" column.
     *
     * @return string
     */
    public static function getOwnerColumn()
    {
        return defined('static::OWNER_COLUMN') ? static::OWNER_COLUMN : 'owner_id';
    }

    function owner() {
        return $this->belongsTo(User::class);
    }
}
