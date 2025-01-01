<?php

namespace Database\Implementations;

use Database\DataAccess\PostDAO;
use Database\MySQLWrapper;
use Models\Post;

class PostDAOImpl implements PostDAO
{

    public function create(Post $post): bool
    {
        if ($post->getId() == null) throw new \Exception("Post id cannot be null");

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

    public function getByUserId(int $userId): ?array
    {
        return null;
    }

    public function countByUserId(int $userId): int
    {
        return 0;
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