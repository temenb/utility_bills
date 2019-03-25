<?php

namespace App\Models\Entities\Traits\Active;

trait Enabled
{
    /**
     * Boot the active trait for a model.
     *
     * @return void
     */
    public static function bootEnabled()
    {
        static::addGlobalScope(new EnabledScope);
    }

    /**
     * Get the name of the "active" column.
     *
     * @return string
     */
    public function getEnabledColumn()
    {
        return defined('static::ENABLED_COLUMN') ? static::ENABLED_COLUMN : 'enabled';
    }

    /**
     * Get the fully qualified "active" column.
     *
     * @return string
     */
    public function getQualifiedEnabledColumn()
    {
        return $this->qualifyColumn($this->getEnabledColumn());
    }
}
