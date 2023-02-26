<?php

namespace GeekBrains\LevelTwo\Blog\Repositories\UsersRepository;

use GeekBrains\LevelTwo\Blog\Exceptions\UserNotFoundException;
use GGeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\UUID;

class DummyUsersRepository implements UsersRepositoryInterface
{

    public function save(User $user): void
    {}

    public function get(UUID $uuid): User
    {
        throw new UserNotFoundException("Not found");
    }

    public function getByUsername(string $username): User
    {
        return new User(
            UUID::random(),
            "user123",
            'some_password',
            "first",
            "last"
        );
    }
}
