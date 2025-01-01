<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Like implements Interfaces\Model
{
    use GenericModel;

    public function __construct(
        private int $userId,
        private int $postId,
    ){}

    public function getUserId(): int {
        return $this->userId;
    }

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getPostId(): int {
        return $this->postId;
    }

    public function setPostId(int $postId): void {
        $this->postId = $postId;
    }
}