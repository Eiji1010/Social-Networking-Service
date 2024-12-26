<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Database\DAOFactory;
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
            'data_type' => '?int',
            'column_name' => 'receiverId'
        ],
        'created_at' => [
            'data_type' => 'string',
            'column_name' => 'created_at'
        ],
    ];

    public function createRowData(int $num=1): array
    {
        $userDao = DAOFactory::getUserDAO();
        $users = $userDao->getAll();
        $ids = [];
        foreach ($users as $user){
            $ids[] = $user->getId();
        }
        $senderIds = $ids;
        $receiverIds = $ids + [null];

        $data = [];
        $faker = Factory::create();
        for ($i = 0; $i < $num; $i++){
            $data[] = [
                'content' => $faker->text,
                'senderId' => $faker->randomElement($senderIds),
                'receiverId' => $faker->randomElement($receiverIds),
                'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s')
            ];
        }
        return $data;
    }
}