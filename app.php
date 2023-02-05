<?php

use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\UUID;
use GeekBrains\LevelTwo\Person\Name;
use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Comment;


include __DIR__ . "/vendor/autoload.php";

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

$usersRepository = new SqliteUsersRepository($connection);

$usersRepository->save(new User(UUID::random(), new Name('Anya', 'Nikitina'), 'admin'));
$usersRepository->save(new User(UUID::random(), new Name('Anna', 'Petrova'), 'user'));


$faker = Faker\Factory::create('ru_RU');
$name = new Name(
    $faker->firstName('female'),
    $faker->lastName('female')
);
$user = new User(
    $faker->randomDigitNotNull(),
    $name,
    $faker->sentence(1));

$route = $argv[1] ?? null;

switch ($route) {
    case "user":
        echo $user;
        break;
    case "post":
        $post = new Post(
            $faker->randomDigitNotNull(),
            $user,
            $faker->realText(rand(50, 100))
        );
        echo $post;
        break;
    case "comment":
        $post = new Post(
            $faker->randomDigitNotNull(),
            $user,
            $faker->realText(rand(50, 100))
        );
        $comment = new Comment(
            $faker->randomDigitNotNull(),
            $user,
            $post,
            $faker->realText(rand(20, 70))
        );
        echo $comment;
        break;
    default:
        echo "error try user post comment parametr";
}