<?php

namespace Database\Implementations;

use Database\DataAccess\MessageDAO;
use Database\MySQLWrapper;
use Models\Message;

class MessageDAOImpl implements MessageDAO
{

    public function create(Message $message): bool
    {
        if ($message->getId() !== null)  throw new \Exception("Message already exists");

        $mysqli = new MySQLWrapper();
        $query = "INSERT INTO messages (senderId, receiverId, content) VALUES (?, ?, ?)";

        $result = $mysqli->prepareAndExecute(
            $query,
            'iis',
            [
                $message->getSenderId(),
                $message->getReceiverId(),
                $message->getContent()
            ]
        );
        if (!$result) return false;
        return true;
    }

    public function getById(int $id): ?Message
    {
        $messageRaw = $this->getRawById($id);
        if ($messageRaw === null) return null;
        return $this->rawDataToMessage($messageRaw);
    }

    public function getBySenderId(int $senderId, string $sort='desc'): ?array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM messages WHERE senderId = ? ORDER BY created_at $sort";
        $messageRaw = $mysqli->prepareAndFetchAll($query, 'i', [$senderId]);
        if ($messageRaw === null) return null;
        return array_map(fn($messageRaw) => $this->rawDataToMessage($messageRaw), $messageRaw);
    }

    private function getRawById(int $id): ?array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM messages WHERE id = ?";
        return $mysqli->prepareAndFetchAll($query, 'i', [$id])[0] ?? null;
    }

    private function rawDataToMessage(array $messageRaw): Message
    {
        return new Message(
            senderId: $messageRaw['senderId'],
            content: $messageRaw['content'],
            receiverId: $messageRaw['receiverId'],
            id: $messageRaw['id'],
        );
    }
}