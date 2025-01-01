<?php

namespace Database\DataAccess;



use Models\Comment;

interface CommentDAO
{
    public function create(Comment $comment): bool;
}