<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Follow implements Interfaces\Model
{
    use GenericModel;

    public function __construct(
        private int $followerId,
        private int $followedId,
    ){}

    public function getFollowerId(): int {
        return $this->followerId;
    }

    public function setFollowerId(int $followerId): void {
        $this->followerId = $followerId;
    }

    public function getFollowedId(): int {
        return $this->followedId;
    }

    public function setFollowedId(int $followedId): void {
        $this->followedId = $followedId;
    }
}