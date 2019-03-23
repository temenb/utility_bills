<?php

namespace App\Events;

trait StoreObjectTrait
{
    private $object;

    /**
     * @return MeterValue
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param $object
     */
    protected function setObject($object)
    {
        $this->object = $object;
    }
}
