<?php

namespace App\Models\Entities\Traits;

trait EnumType
{
    /**
     * @param array $enumTypeValues
     * @param string $prefix
     * @return array
     * @throws \ReflectionException
     */
    static public function extractEnum($enumTypeValues = [], $prefix = 'ENUM_')
    {
        if (!$enumTypeValues) {
            $enumTypeValues = [];
            $oClass = new \ReflectionClass(self::class);
            $constants = $oClass->getConstants();
            foreach ($constants as $name => $value) {
                if (0 === strpos($name, $prefix)){
                    $enumTypeValues[$name] = $value;
                }
            }
        }
        return $enumTypeValues;
    }
}
