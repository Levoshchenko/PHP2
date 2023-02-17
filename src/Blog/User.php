<?php

namespace GeekBrains\LevelTwo\Blog;
use GeekBrains\LevelTwo\Blog\UUID;
use GeekBrains\LevelTwo\Person\Name;

class User
{
    private $hashedPassword;
	 
    public function __construct(
        private UUID $uuid,
        private string $username,
        private string $password,
        private Name $name
    )
    {
    }
    
     /**
     * @param string $username
     * @param string $password
     * @param Name $name
     * @return static
     */
    public static function createFrom(
        string $username,
        string $password,
        Name $name
    ): self
    {
        $uuid = UUID::random();
        return new self(
            $uuid,
            $username,
            self::hash($password, $uuid),
            $name
        );
    }



    /**
     * @return UUID
     */
    public function uuid(): UUID
    {
        return $this->uuid;
    }
    
        /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function hashedPassword(): string
    {
        return $this->hashedPassword;
    }

    /**
     * @param string $password
     * @return string
     */
    private static function hash(string $password, UUID $uuid): string
    {
        return hash('sha256', $uuid . $password);
    }
    
    /**
     * @param string $password
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        return $this->hashedPassword === self::hash($password, $this->getUuid());
    }

     

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    
        public function __toString(): string
    {
        return "Юзер $this->uuid с именем $this->name и логином $this->username." . PHP_EOL;
    }
    

}
