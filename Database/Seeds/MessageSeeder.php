<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Faker\Factory;

class MessageSeeder extends AbstractSeeder
{

    protected ?string $tableName = 'messages';
    protected array $tableColumns = [
        'content' => [
            'data_type' => 'string',
            'column_name' => 'content'
        ],
        'senderId' => [
            'data_type' => 'int',
            'column_name' => 'senderId'
        ],
        'receiverId' => [
            'data_type' => 'int',
            'column_name' => 'receiverId'
        ],
        'created_at' => [
            'data_type' => 'string',
            'column_name' => 'created_at'
        ],
    ];

    public function createRowData(int $num=1): array
    {
        $data = [];
        $faker = Factory::create();
        for ($i = 0; $i < $num; $i++){
            $data[] = [
                'content' => $faker->text,
                'senderId' => $faker->numberBetween(1, 10),
                'receiverId' => $faker->numberBetween(1, 10),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s')
            ];
        }
        return $data;
    }
}