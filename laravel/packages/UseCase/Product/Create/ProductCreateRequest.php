<?php


namespace Packages\UseCase\Product\Create;


class ProductCreateRequest
{
    /** @var string */
    private $name;

    /** @var int */
    private $price;

    /** @var int */
    private $stock;

    /** @var string */
    private $shopId;

    /** @var string */
    private $userId;

    /**
     * ProductCreateRequest constructor.
     * @param string $name
     * @param int $price
     * @param int $stock
     * @param string $shopId
     */
    public function __construct(string $name, int $price, int $stock, string $shopId, string $userId)
    {
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->shopId = $shopId;
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
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getStock(): int
    {
        return $this->stock;
    }

    /**
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }


}
