<?php

namespace Database\DataAccess;

use Models\Post;

interface PostDAO
{
    public function create(Post $post): bool;
    public function getById(int $id): ?Post;
    public function getByUserId(int $userId): ?array;
    public function countByUserId($userId): int;
    
}