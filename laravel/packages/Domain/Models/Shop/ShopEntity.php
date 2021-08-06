<?php

namespace Packages\Domain\Models\Shop;


class ShopEntity
{
    /** @var ShopId */
    private $id;

    /** @var ShopName */
    private $name;

    /** @var ShopUserId */
    private $userId;

    /**
     * ShopEntity constructor.
     * @param ShopId $id
     * @param ShopName $name
     * @param ShopUserId $userId
     */
    public function __construct(ShopId $id, ShopName $name, ShopUserId $userId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->userId = $userId;
    }

    /**
     * @return Id
     */
    public function getId(): ShopId
    {
        return $this->id;
    }

    /**
     * @return ShopName
     */
    public function getName(): ShopName
    {
        return $this->name;
    }

    /**
     * @return ShopUserId
     */
    public function getUserId(): ShopUserId
    {
        return $this->userId;
    }
}
