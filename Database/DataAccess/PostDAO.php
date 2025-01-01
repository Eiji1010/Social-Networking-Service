<?php

namespace Database\DataAccess;

use Models\Post;

interface PostDAO
{
    public function create(Post $post): bool;
    public function getById(int $id): ?Post;
    public function getByUserId(int $userId, ?int $offset=null, ?int $count=null, string $sort): ?array;
    public function countByUserId(int $userId): int;
    public function getAll():array;
}