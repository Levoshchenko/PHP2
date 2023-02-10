<?php

namespace GeekBrains\LevelTwo\Blog\Repositories\PostsRepository;

use GeekBrains\LevelTwo\Blog\Exceptions\InvalidArgumentException;
use GeekBrains\LevelTwo\Blog\Exceptions\PostNotFoundException;
use GeekBrains\LevelTwo\Blog\Exceptions\UserNotFoundException;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\UUID;

class SqlitePostsRepository implements PostsRepositoryInterface
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO posts(uuid, author_uuid, title, text) VALUES (:uuid, :author_uuid, :title, :text)'
        );

        $statement->execute([
            ':uuid' => $post->getUuid(),
            ':author_uuid' => $post->getUser()->uuid(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText()
        ]);
    }

    /**
     * @throws PostNotFoundException
     * @throws UserNotFoundException
     * @throws InvalidArgumentException
     */
    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );
        $statement->execute([
            ':uuid'=>(string)$uuid,
        ]);

        return $this->getPost($statement, $uuid);
    }

    /**
     * @throws PostNotFoundException
     * @throws InvalidArgumentException
     * @throws UserNotFoundException
     */
    private function getPost(\PDOStatement $statement, string $postUuid): Post
    {
        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if($result === false) {
            throw new PostNotFoundException(
                "Cannot find post: $postUuid"
            );
        }

        $userRepository = new SqliteUsersRepository($this->connection);
        $user = $userRepository->get(new UUID($result['author_uuid']));

        return new Post(
            new UUID($result['uuid']),
            $user,
            $result['title'],
            $result['text']
        );

    }

    /**
     * @throws PostNotFoundException
     */
    public function deletePost(UUID $postUuId): bool
    {
        $statement = $this->connection->prepare(
            'DELETE FROM posts WHERE uuid = :uuid'
        );

        $result = $statement->execute([
            ':uuid' => $postUuId,
        ]);

        if (!$result) {
            throw new PostNotFoundException(
                "Cannot not delete: $postUuId"
            );
        }
        return true;
    }
    
    
    /**
     * @throws PostNotFoundException
     * @throws UserNotFoundException|InvalidArgumentException
     */
    public function getPost(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            'SELECT * FROM posts WHERE uuid = :uuid'
        );

        $statement->execute([
            ':uuid' => $uuid,
        ]);

        return $this->getPost($statement, $uuid);
    }
