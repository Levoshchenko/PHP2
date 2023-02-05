<?php

use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use GeekBrains\LevelTwo\Blog\UUID;

include __DIR__ . "/vendor/autoload.php";

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

$userRepository = new SqliteUsersRepository($connection);
$postsRepository = new SqlitePostsRepository($connection);

try {
    $user = $userRepository->get(new UUID('bab851d7-d24e-447d-957e-4e7daa65a946'));

    $post = $postsRepository->get(new UUID('ff932e66-3c96-4325-a6b2-641cacb1c6b8'));

print_r($post);
} catch (Exception $e) {
    echo $e->getMessage();
}
