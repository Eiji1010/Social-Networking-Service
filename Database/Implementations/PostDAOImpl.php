<?php

namespace Database\Implementations;

use Database\DataAccess\PostDAO;
use Database\MySQLWrapper;
use Models\Post;

class PostDAOImpl implements PostDAO
{

    public function create(Post $post): bool
    {
        if ($post->getId() != null) throw new \Exception("Post already exists in the database.");

        $mysqli = new MySQLWrapper();
        $query = "INSERT INTO posts (userId, content) VALUE (?, ?)";

        $result = $mysqli->prepareAndExecute(
            $query,
            'is',
            [
                $post->getUserId(),
                $post->getContent()
            ]
        );

        if (!$result) return false;
        return true;
    }

    public function getById(int $id): ?Post
    {
        return null;
    }

    public function getByUserId(int $userId, ?int $offset = null, ?int $count = null, string $sort='desc'): ?array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM posts WHERE userId= ? ORDER BY postDate $sort";
        $params = [$userId];
        $types = 'i';

        if ($offset!== null && $count!== null) {
            $query .= " LIMIT ?, ?";
            $params = array_merge($params, [(int)$offset, (int)$count]);
            $types .= 'ii';
        }

        $messageRaw = $mysqli->prepareAndFetchAll($query, $types, $params);
        if ($messageRaw === null) return null;
        return array_map(fn($messageRaw) => $this->rawDataToPost($messageRaw), $messageRaw);
    }

    public function countByUserId(int $userId): int
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT COUNT(*) FROM posts WHERE userId = ?";
        $result = $mysqli->prepareAndFetchAll($query, 'i', [$userId]);

        return (int)$result[0]['COUNT(*)'];
    }

    public function getAll(): array
    {
        $mysqli = new MySQLWrapper();
        $query = "SELECT * FROM posts";
        $rawData = $mysqli->query($query);
        $posts = [];
        foreach ($rawData as $rawPost) {
            $posts[] = $this->rawDataToPost($rawPost);
        }
        return $posts;
    }

    private function rawDataToPost(array $rawPost): Post
    {
        return new Post(
            userId: $rawPost['userId'],
            content: $rawPost['content'],
            id: $rawPost['id'],
        );
    }
}