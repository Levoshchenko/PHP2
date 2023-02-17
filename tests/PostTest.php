<?php


use GeekBrains\LevelTwo\Blog\Post;
use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\UUID;
use GeekBrains\LevelTwo\Person\Name;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    public function testPostGets(): void
    {
        $post = new Post(
            new UUID('ff932e66-3c96-4325-a6b2-641cacb1c6b8'),
            new User(
                new UUID('ff932e66-3c96-4325-a6b2-641cacb1c6b8'),
                'login',
                'pass',
                new Name('fname', 'lname')
            ),
            'title',
            'text'
        );
        $value = $post->getUuid();
        $this->assertEquals('ff932e66-3c96-4325-a6b2-641cacb1c6b8', $value);

        $title = $post->getTitle();
        $this->assertEquals('title', $title);

        $text = $post->getText();
        $this->assertEquals('text', $text);

    }

}
