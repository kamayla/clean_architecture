<?php


namespace Packages\UseCase\User\Get;


class UserGetRequest
{
    /** @var string */
    private $id;

    /**
     * UserGetRequest constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
