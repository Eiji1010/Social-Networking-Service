<?php

namespace Models;

use Models\Interfaces\Model;
use Models\Traits\GenericModel;

class Comment implements Interfaces\Model
{
    use GenericModel;

    public function __construct(
        private string $comment,
        private int $postId,
        private int $userId,
        private ?int $id = null,
        private ?string $postDate = null
    ){}
}