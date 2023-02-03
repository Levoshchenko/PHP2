<?php

namespace GeekBrains\LevelTwo\Blog;

class Post
{
    private UUID $uuid;
    private User $user;
    private string $title;
    private string $text;

    public function __construct(
        UUID $uuid,
        User $user,
        string $title,
        string $text
    )
    {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->text = $text;
        $this->user = $user;
    }

    /**
     * @return UUID
     */
    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    /**
     * @param UUID $uuid
     */
    public function setUuid(UUID $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function __toString()
    {
        return $this->user.'пишет:'.$this->text.PHP_EOL;
    }

}