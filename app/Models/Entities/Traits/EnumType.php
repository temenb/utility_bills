<?php

namespace App\Models\Entities\Traits;

trait EnumType
{

    static public function extractEnumType($enumTypeValues = [], $prefix = 'ENUM_TYPE_') {
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
