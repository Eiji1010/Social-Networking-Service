<?php

namespace Database\DataAccess;

use Models\Message;

interface MessageDAO
{
    public function create(Message $message): bool;
    public function getById(int $id): ?Message;
    public function getBySenderId(int $senderId): ?array;
    public function countBySenderId($userId): int;
}