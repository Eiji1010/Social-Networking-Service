<?php

namespace Database\DataAccess;

interface FollowerPostDAO
{
    public function getFollowerPosts(int $userId, ?int $offset=null, ?int $count=null): ?array;
    public function getFollowerPostsCount(int $userId): int;
}