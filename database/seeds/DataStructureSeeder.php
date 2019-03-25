<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\Meter;
use App\Models\Entities\User;
use Illuminate\Database\Eloquent\Collection;

class DataStructureSeeder extends Seeder
{
    public $entitiesClassPrefix = '\\App\\Models\\Entities\\';
    public $data = [
        'users' => [
            [
                'a' => [
                    'name' => 'temenb',
                    'email' => 'temenb@gmail.com',
                ],
                'r' => [
                    'organizations' => [
                        ['a' => ['name' => 'Без сервисов']],
                        [
                            'a' => ['name' => 'Без счетчиков'],
                            'r' => [
                                'services' => [['a' => ['name' => 'Без счетчиков']]],
                            ]
                        ],
                        [
                            'a' => ['name' => "Коммунальные платежи"],
                            'r' => [
                                'services' => [
                                    [
                                        'a' => ['name' => 'Электроснабжение'],
                                        'r' => [
                                            'meters' => [
                                                [
                                                    'a' => [
                                                        'type' => Meter::ENUM_TYPE_MEASURING,
                                                        'value' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'a' => ['name' => "Домофон"],
                            'r' => [
                                'services' => [
                                    [
                                        'a' => ['name' => 'Домофон'],
                                        'r' => [
                                            'meters' => [
                                                [
                                                    'a' => [
                                                        'type' => Meter::ENUM_TYPE_MEASURING,
                                                        'value' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'a' => ['name' => "Triolan"],
                            'r' => [
                                'services' => [
                                    [
                                        'a' => ['name' => 'Интернет'],
                                        'r' => [
                                            'meters' => [
                                                [
                                                    'a' => [
                                                        'type' => Meter::ENUM_TYPE_MEASURING,
                                                        'value' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'a' => ['name' => "Пенсионный фонд"],
                            'r' => [
                                'services' => [
                                    [
                                        'a' => ['name' => 'Пенсионный фонд'],
                                        'r' => [
                                            'meters' => [
                                                [
                                                    'a' => [
                                                        'type' => Meter::ENUM_TYPE_MEASURING,
                                                        'value' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createEntitiesWithRelations($this->data);
    }

    /**
     * @param $entitiesData
     */
    private function createEntitiesWithRelations($entitiesData)
    {
        foreach ($entitiesData as $entityName => $data) {;
            foreach ($data as $_data) {
                $_data = $this->addDefaultProps($entityName, $_data);
                $entity = $this->newEntity($_data['c'], $_data['a']);
                $entity->save();
                $this->createRelations($entity, $_data['r']);
            }
        }
    }

    /**
     * @param $entity
     * @param array $relations
     */
    private function createRelations($entity, array $relations)
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
     * @param $className
     * @param $attributes
     * @return mixed
     */
    private function newEntity($className, $attributes)
    {
        $entity = new $className($attributes);
        switch ($className) {
            case "\\App\\Models\\Entities\\User":
                $this->beforeUserCreate($entity, $attributes);
        }
        return $entity;
    }

    /**
     * @param User $entity
     * @param array $data
     */
    private function beforeUserCreate(User $entity, array $data)
    {
        $entity->setAttribute('password', bcrypt(strrev($data['name'])))->save();
        Auth::login($entity);
    }

    /**
     * @param $entityName
     * @return string
     */
    private function generateClassName($entityName): string
    {
        return $this->entitiesClassPrefix . ucfirst(substr($entityName, 0, strlen($entityName) - 1));
    }

    /**
     * @param $entityName
     * @param array $_data
     * @return array
     */
    private function addDefaultProps($entityName, array $_data): array
    {
        $_data += [
            'c' => $this->generateClassName($entityName),
            'a' => [],
            'r' => [],
        ];
        return $_data;
    }

}