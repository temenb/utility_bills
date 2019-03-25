<?php

use App\Models\Entities\Meter;
use App\Models\Entities\User;

class DataStructureSeeder extends CascadeSeeder
{
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
                                                        'rate' => 1,
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                    [
                                        'a' => ['name' => 'Теплоснабжение'],
                                        'r' => [
                                            'meters' => [
                                                [
                                                    'a' => [
                                                        'type' => Meter::ENUM_TYPE_MEASURING,
                                                        'rate' => 1,
                                                    ],
                                                ],
                                                [
                                                    'a' => [
                                                        'type' => Meter::ENUM_TYPE_MEASURING,
                                                        'rate' => 1,
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
                                                        'type' => Meter::ENUM_TYPE_MONTHLY,
                                                        'rate' => 1,
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
                                                        'type' => Meter::ENUM_TYPE_DAILY,
                                                        'rate' => 1,
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
                                                        'type' => Meter::ENUM_TYPE_QUARTERLY,
                                                        'rate' => 1,
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
     * @param User $entity
     * @param array $data
     */
    public function beforeMainEntityCreated($entity, array $data)
    {
        if ($entity instanceof User) {
            $entity->setAttribute('password', bcrypt(strrev($data['name'])))->save();
            Auth::login($entity);
        }
    }

}