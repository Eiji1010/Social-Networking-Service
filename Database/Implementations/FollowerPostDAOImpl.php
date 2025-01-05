<?php

namespace Database\Implementations;

use Database\DataAccess\FollowerPostDAO;
use Database\MySQLWrapper;

class FollowerPostDAOImpl implements FollowerPostDAO
{

    public function getFollowerPosts(int $userId, ?int $offset = null, ?int $count = null): ?array
    {
        $mysqli = new MySQLWrapper();

        // $userIdがフォローしているユーザーの投稿とユーザー名、コメント数、いいね数を取得
        $query ="
            SELECT 
                posts.id AS post_id,
                users.username AS poster_username,
                posts.content AS post_content,
                posts.mediaUrl AS post_media,
                posts.postDate AS post_date,
                COUNT(DISTINCT comments.id) AS comment_count,
                COUNT(DISTINCT likes.id) AS like_count
            FROM 
                follows
            JOIN 
                users ON follows.followeeId = users.id
            JOIN 
                posts ON users.id = posts.userId
            LEFT JOIN 
                comments ON posts.id = comments.postId
            LEFT JOIN 
                likes ON posts.id = likes.postId
            WHERE 
                follows.followerId = ? -- フォロワーのIDを指定
            GROUP BY 
                posts.id, users.username, posts.content, posts.mediaUrl, posts.postDate
            ORDER BY 
                posts.postDate DESC";

        $params = [$userId];
        $types = 'i';
        if ($offset!== null && $count!== null) {
            $query .= " LIMIT ?, ?";
            $params = array_merge($params, [(int)$offset, (int)$count]);
            $types .= 'ii';
        }

        $rawData = $mysqli->prepareAndFetchAll($query, $types, $params);

        return $rawData;
    }

    public function getFollowerPostsCount(int $userId): int
    {
        $mysqli = new MySQLWrapper();
        $query = "
            SELECT 
                COUNT(DISTINCT posts.id) AS post_count
            FROM 
                follows
            JOIN 
                users ON follows.followeeId = users.id
            JOIN 
                posts ON users.id = posts.userId
            WHERE 
                follows.followerId = ?";

        $result = $mysqli->prepareAndFetchAll($query, 'i', [$userId]);
        return $result[0]['post_count'];
    }
}