<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Models\Entities\MeterData;
use App\Models\Entities\MeterDept;
use App\Models\Entities\User;
use App\Models\Entities\ServiceValue;
use Illuminate\Database\Eloquent\Model;

abstract class CascadeSeeder extends Seeder
{
    public $entitiesClassPrefix = 'App\\Models\\Entities\\';

    /**
     * @param $entitiesData
     */
    public function createEntitiesWithRelations($entitiesData)
    {
        foreach ($entitiesData as $entityName => $data) {;
            foreach ($data as $_data) {
                $_data = $this->addDefaultProps($entityName, $_data);
                $entity = $this->newEntity($_data['c'], $_data['a']);
                $this->beforeMainEntityCreated($entity, $_data['a']);
                $entity->save();
                $this->createRelations($entity, $_data['r']);
            }
        }
    }

    /**
     * @param $entity
     * @param array $relations
     */
    protected function createRelations($entity, array $relations)
    {
        foreach ($relations as $entityName => $_data) {
            foreach ($_data as $dirtyData) {
                $data = $this->addDefaultProps($entityName, $dirtyData);
                $relatedEntity = $this->newEntity($data['c'], $data['a']);
                $entity->$entityName()->save($relatedEntity);
                $this->createRelations($relatedEntity, $data['r']);
            }
        }
    }

    /**
     * @param $entity
     * @param array $data
     */
    public function beforeMainEntityCreated($entity, array $data)
    {
    }

    /**
     * @param $className
     * @param $attributes
     * @return mixed
     */
    public function newEntity($className, $attributes)
    {
        return factory($className)->make($attributes);
    }

    /**
     * @param $entityName
     * @return string
     */
    protected function generateClassName($entityName): string
    {
        return $this->entitiesClassPrefix . ucfirst(substr($entityName, 0, strlen($entityName) - 1));
    }

    /**
     * @param $entityName
     * @param array $_data
     * @return array
     */
    protected function addDefaultProps($entityName, array $_data): array
    {
        $_data += [
            'c' => $this->generateClassName($entityName),
            'a' => [],
            'r' => [],
        ];
        return $_data;
    }
}
