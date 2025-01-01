<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Database\DAOFactory;
use Faker\Factory;

class PostSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'posts';
    protected array $tableColumns = [
        'userId' => [
            'data_type' => 'int',
            'column_name' => 'userId'
        ],
        'content' => [
            'data_type' => 'string',
            'column_name' => 'content'
        ],
        'mediaUrl' => [
            'data_type' => '?string',
            'column_name' => 'mediaUrl'
        ],
        'isScheduled' => [
            'data_type' => 'bool',
            'column_name' => 'isScheduled'
        ],
        'scheduled_at' => [
            'data_type' => '?string',
            'column_name' => 'scheduled_at'
        ],
        'postDate' => [
            'data_type' => 'string',
            'column_name' => 'postDate'
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
        $userIds = $ids;

        $data = [];
        $faker = Factory::create();
        for ($i=0; $i<$num; $i++){
            $data[] = [
                'userId' => $faker->randomElement($userIds),
                'content' => $faker->text,
                'mediaUrl' => null,
                'isScheduled' => false,
                'scheduled_at' => null,
                'postDate' => $faker->dateTimeThisCentury()->format('Y-m-d H:i:s')
            ];
        }
        return $data;
    }
}