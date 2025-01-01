<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Database\DAOFactory;
use Faker\Factory;

class CommentSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'comments';
    protected array $tableColumns = [
        'userId' => [
            'data_type' => 'int',
            'column_name' => 'userId'
        ],
        'postId' => [
            'data_type' => 'int',
            'column_name' => 'postId'
        ],
        'content' => [
            'data_type' => 'string',
            'column_name' => 'content'
        ],
        'commentDate' => [
            'data_type' => 'string',
            'column_name' => 'PostDate'
        ],
    ];

    public function createRowData(int $n=1): array
    {
        $userDao = DAOFactory::getUserDAO();
        $users = $userDao->getAll();
        $userIds = [];
        foreach ($users as $user){
            $userIds[] = $user->getId();
        }

        $postDao = DAOFactory::getPostDAO();
        $posts = $postDao->getAll();
        $postIds = [];
        foreach ($posts as $post){
            $postIds[] = $post->getId();
        }

        $data = [];
        $faker = Factory::create();
        for ($i=0; $i<$n; $i++){
            $data[] = [
                'userId' => $faker->randomElement($userIds),
                'postId' => $faker->randomElement($postIds),
                'content' => $faker->text,
                'commentDate' => $faker->dateTimeThisYear->format('Y-m-d H:i:s')
            ];
        }
        return $data;
    }
}