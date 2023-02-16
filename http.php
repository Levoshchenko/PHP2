<?php

use GeekBrains\LevelTwo\Blog\Exceptions\AppException;
use GeekBrains\LevelTwo\Blog\Exceptions\HttpException as HttpExceptionAlias;
use GeekBrains\LevelTwo\Blog\Repositories\CommentsRepository\SqliteCommentsRepository as SqliteCommentsRepositoryAlias;
use GeekBrains\LevelTwo\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use GeekBrains\LevelTwo\Blog\Repositories\UsersRepository\SqliteUsersRepository;
use GeekBrains\LevelTwo\Http\Actions\Comments\CreateComment;
use GeekBrains\LevelTwo\Http\Actions\Posts\CreatePost;
use GeekBrains\LevelTwo\Http\Actions\Posts\DeletePost;
use GeekBrains\LevelTwo\Http\Actions\User\CreateUser;
use GeekBrains\LevelTwo\Http\Actions\User\FindByUsername;
use GeekBrains\LevelTwo\Http\ErrorResponse;
use GeekBrains\LevelTwo\Http\Request;
use GeekBrains\LevelTwo\Http\SuccessfulResponse;

$container = require __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/vendor/autoload.php';

$request = new Request(
$_GET, 
$_SERVER, 
file_get_contents('php://input'));

$logger = $container->get(LoggerInterface::class);

try {
    $path = $request->path();
} catch (HttpException $e) {
    $logger->warning($e->getMessage());
    (new ErrorResponse)->send();
    return;
}


try {
    $method = $request->method();
}catch (HttpExceptionAlias $e) {
    $logger->warning($e->getMessage());

    (new ErrorResponse)->send();
    return;
}

$routes = [
    'GET' => [
        '/users/show' => FindByUsername::class,
        '/postlikes/show' => FindLikesByPost::class
    ],
    'DELETE' => [
        '/post' => DeletePost::class
    ],
    'POST' => [
        '/user/create' => CreateUser::class,
        '/posts/create' => CreatePost::class,
        '/posts/comment' => CreateComment::class,
        '/posts/like' => AddLike::class
    ],
];

if (!array_key_exists($method, $routes)
    || !array_key_exists($path, $routes[$method])) {
    $message = "Route not found: $method $path";
    $logger->error($message);
    (new ErrorResponse($message))->send();
    return;
}


$actionClassName = $routes[$method][$path];

$action = $container->get($actionClassName);

try {
    $response = $action->handle($request);
    $response->send();
} catch (AppException $e) {
    $logger->error($e->getMessage(), ['exception' => $e]);
    (new ErrorResponse($e->getMessage()))->send();
}



