<?php

namespace Database\DataAccess;

use Models\Follow;

interface FollowDAO
{
    public function create(Follow $follow): bool;
    public function getById(int $id): ?Follow;
    public function getByFollowerId(int $followerId): ?array;
    public function getByFollowedId(int $followedId): ?array;
}