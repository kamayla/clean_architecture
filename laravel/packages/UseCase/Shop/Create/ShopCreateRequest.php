<?php


namespace Packages\UseCase\Shop\Create;


class ShopCreateRequest
{
    /** @var string */
    private $name;

    /** @var string */
    private $userId;

    public function __construct(string $name, string $userId)
    {
        $this->name = $name;
        $this->userId = $userId;
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
    public function getUserId(): string
    {
        return $this->userId;
    }

}
