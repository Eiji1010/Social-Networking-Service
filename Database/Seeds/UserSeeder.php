<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Faker\Factory;

class UserSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'users';
    protected array $tableColumns = [
        'username' => [
            'data_type' => 'string',
            'column_name' => 'username'
        ],
        'email' => [
            'data_type' => 'string',
            'column_name' => 'email'
        ],
        'password' => [
            'data_type' => 'string',
            'column_name' => 'password'
        ],
        'handle' => [
            'data_type' => 'string',
            'column_name' => 'handle'
        ],
        'age' => [
            'data_type' => 'int',
            'column_name' => 'age'
        ],
        'place' => [
            'data_type' => 'string',
            'column_name' => 'place'
        ],
        'biography' => [
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
                'password' => password_hash($faker->password, PASSWORD_DEFAULT),
                'handle' => $faker->userName,
                'age' => $faker->numberBetween(10, 100),
                'place' => $faker->address,
                'biography' => $faker->text,
            ];
        }
        return $data;
    }
}