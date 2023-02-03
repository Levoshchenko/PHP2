<?php

use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use GeekBrains\LevelTwo\Blog\UUID;

include __DIR__ . "/vendor/autoload.php";

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

$userRepository = new SqliteUsersRepository($connection);
$postsRepository = new SqlitePostsRepository($connection);

try {
    $user = $userRepository->get(new UUID(''));

    $post = $postsRepository->get(new UUID(''));


} catch (Exception $e) {
    echo $e->getMessage();
}
