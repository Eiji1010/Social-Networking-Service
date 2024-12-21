<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Faker\Factory;

class UserSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'users';
    protected array $tableColumns = [
        [
            'data_type' => 'string',
            'column_name' => 'username'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'email'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'password'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'handle'
        ],
        [
            'data_type' => 'int',
            'column_name' => 'age'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'place'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'biography'
        ],
    ];

    public function createRowData(int $num=1): array
    {
        $data = [];
        $faker = Factory::create();
        for ($i = 0; $i < $num; $i++) {
            // fakerでデータを生成
            $data[] = [
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->password,
                'handle' => $faker->userName,
                'age' => $faker->numberBetween(10, 100),
                'place' => $faker->address,
                'biography' => $faker->text,
            ];
        }
        return $data;
    }
}