<?php

namespace Database\DataAccess;

use Models\Like;

interface LikeDAO
{
    public function create(Like $like): bool;
    public function getById(int $id): ?Like;
    public function getByUserId(int $userId): ?array;
    public function getByPostId(int $postId): ?array;
}