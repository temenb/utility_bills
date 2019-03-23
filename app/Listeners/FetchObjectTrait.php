<?php

namespace App\Listeners;

trait FetchObjectTrait
{
    /**
     * @param $object
     * @param string $class
     * @return mixed
     * @throws \Exception
     */
    private function fetchObject($object, string $class)
    {
        if ($object instanceof $class) {
            $result = $object;
        } else if (is_callable([$object, 'getObject'])) {
            $result = $object->getObject();
        } else {
            throw new \Exception('MeterValue entity is not found.');
        }
        return $result;
    }
}
