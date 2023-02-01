<?php

namespace GeekBrains\LevelTwo\Blog;

class Post
{
    private int $id;
    private User $user;
    private string $text;

    public function __construct(
        int $id,
        User $user,
        string $text
    )
    {
        $this->id = $id;
        $this->text = $text;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \GeekBrains\LevelTwo\Blog\User
     */
    public function getUser(): \GeekBrains\LevelTwo\Blog\User
    {
        return $this->user;
    }

    /**
     * @param \GeekBrains\LevelTwo\Blog\User $user
     */
    public function setUser(\GeekBrains\LevelTwo\Blog\User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->user.'пишет:'.$this->text.PHP_EOL;
    }

}