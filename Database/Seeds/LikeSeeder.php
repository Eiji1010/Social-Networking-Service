<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Database\DAOFactory;
use Faker\Factory;

class LikeSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'likes';
    protected array $tableColumns = [
        'userId' => [
            'data_type' => 'int',
            'column_name' => 'userId'
        ],
        'postId' => [
            'data_type' => 'int',
            'column_name' => 'postId'
        ],
    ];

    public function createRowData(int $num=1): array
    {
        $postDao = DAOFactory::getPostDAO();
        $posts = $postDao->getAll();
        $postIds = [];
        foreach ($posts as $post){
            $postIds[] = $post->getId();
        }
        $userDao = DAOFactory::getUserDAO();
        $users = $userDao->getAll();
        $userIds = [];
        foreach ($users as $user){
            $userIds[] = $user->getId();
        }

        $data = [];
        $faker = Factory::create();
        for ($i = 0; $i < $num; $i++){
            $data[] = [
                'userId' => $faker->randomElement($userIds),
                'postId' => $faker->randomElement($postIds),
            ];
        }
        return $data;
    }
}