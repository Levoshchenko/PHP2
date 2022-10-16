<?php

use GeekBrains\LevelTwo\Blog\Commands\Arguments;
use GeekBrains\LevelTwo\Blog\Commands\CreateUserCommand;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;

require_once __DIR__ . '/vendor/autoload.php';

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

$usersRepository = new SqliteUsersRepository($connection);

$command = new CreateUserCommand($usersRepository);

try {
    $command->handle(Arguments::fromArgv($argv));

    $user = $usersRepository->getByUsername('ivan');
   print $user;

} catch (Exception $exception) {
    echo $exception->getMessage();
}