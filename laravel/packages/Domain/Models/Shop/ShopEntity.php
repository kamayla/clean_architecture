<?php

namespace Packages\Domain\Models\Shop;

use Packages\Domain\Models\User\UserId;

class ShopEntity
{
    /**
     * @var int ショップの作成をするための料金
     * TODO: 本当にここに書くのが正しい？？か検討中
     */
    public const SHOP_CREATE_FEE = 80000;

    /** @var ShopId */
    private $id;

    /** @var ShopName */
    private $name;

    /** @var UserId */
    private $userId;

    /**
     * ShopEntity constructor.
     * @param ShopId $id
     * @param ShopName $name
     * @param UserId $userId
     */
    public function __construct(ShopId $id, ShopName $name, UserId $userId)
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
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }
}
