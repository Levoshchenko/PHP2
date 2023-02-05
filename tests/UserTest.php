<?php


use GeekBrains\LevelTwo\Blog\User;
use GeekBrains\LevelTwo\Blog\UUID;
use GeekBrains\LevelTwo\Person\Name;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserGets(): void
    {
        $user = new User(
            new UUID('ff932e66-3c96-4325-a6b2-641cacb1c6b8'),
            'login',
            new Name('fname', 'lname')
        );
        $value = $user->getUuid();
        $this->assertEquals('ff932e66-3c96-4325-a6b2-641cacb1c6b8', $value);

        $username = $user->getUsername();
        $this->assertEquals('login',$username);

        $username = $user->getLastName();
        $this->assertEquals('lname',$username);

        $name = $user->getName();
        $this->assertEquals('fname lname', $name);
    }

}