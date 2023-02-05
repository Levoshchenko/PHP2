<?php

namespace GeekBrains\LevelTwo\Blog\Repositories\UsersRepository;

use GeekBrains\LevelTwo\Blog\Exceptions\InvalidArgumentException;
use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\UUID;
use GeekBrains\LevelTwo\Blog\Exceptions\UserNotFoundException;
use GeekBrains\LevelTwo\Person\Name;

class DummyUsersRepository implements UsersRepositoryInterface
{

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }

    /**
     * @throws UserNotFoundException
     */
    public function get(UUID $uuid): User
    {
        throw new UserNotFoundException("Not found");
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getByUsername(string $username): User
    {
        return new User(UUID::random(), "user123", new Name("first", "last"));
    }
}