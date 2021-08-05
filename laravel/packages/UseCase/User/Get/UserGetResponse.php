<?php


namespace Packages\UseCase\User\Get;


class UserGetResponse
{
    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /**
     * UserCreateResponse constructor.
     * @param string $name
     * @param string $email
     */
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
