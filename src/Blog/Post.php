<?php

namespace GeekBrains\LevelTwo\Blog;


class Post
{

    public function __construct(
        private UUID $uuid,
        private User $user,
        private string $title,
        private string $text
    )
    {
    }


    /**
     * @return UUID
     */
    public function getUuid(): UUID
    {
        return $this->uuid;
    }


    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }


    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }



    public function __toString()
    {
        return $this->user.'пишет:'.$this->text.PHP_EOL;
    }

}
