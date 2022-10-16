<?php

require_once __DIR__ . '/vendor/autoload.php';

use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\InMemoryUsersRepository;
use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Person\Name;
use GeekBrains\LevelTwo\Person\Person;

try {
    $post = new Post(
        new Person(
            new Name('Иван', 'Никитин'),
            new DateTimeImmutable()
        ),
        'Всем привет!' . PHP_EOL
    );

    print $post;

    $rep = new InMemoryUsersRepository();
    $user1 = new User(1, "Ember Song", "Ember");
    $user2 = new User(2, "Vasa Pumpkin", "Vasa");

    $rep->save($user1);
    $rep->save($user2);

    echo $rep->get(1);
    echo $rep->get(2);
    echo $rep->get(23);


} catch (\Exception $exception) {
    print_r($exception->getMessage());
}