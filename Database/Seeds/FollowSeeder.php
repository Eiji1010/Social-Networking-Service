<?php

namespace Database\Seeds;

use Database\AbstractSeeder;
use Database\DAOFactory;

class FollowSeeder extends AbstractSeeder
{
    protected ?string $tableName = 'follows';
    protected array $tableColumns = [
        'followeeId' => [
            'data_type' => 'int',
            'column_name' => 'followeeId'
        ],
        'followerId' => [
            'data_type' => 'int',
            'column_name' => 'followerId'
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
        $followerIds = $ids;
        $followeeIds = $ids;

        $data = [];
        for ($i = 0; $i < $num; $i++){
            $data[] = [
                'followeeId' => $followeeIds[array_rand($followeeIds)],
                'followerId' => $followerIds[array_rand($followerIds)],
            ];
        }
        return $data;
    }
}