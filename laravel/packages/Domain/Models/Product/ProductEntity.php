<?php

namespace Packages\Domain\Models\Product;

use Packages\Domain\Models\Shop\ShopId;

class ProductEntity
{
    /** @var ProductId */
    private $id;

    /** @var ProductName */
    private $name;

    /** @var ProductPrice */
    private $price;

    /** @var ProductStock */
    private $stock;

    /** @var ShopId */
    private $shopId;

    /**
     * ProductEntity constructor.
     * @param ProductId $id
     * @param ProductName $name
     * @param ProductPrice $price
     * @param ProductStock$stock
     * @param ShopId $shopId
     */
    public function __construct(
        ProductId $id,
        ProductName $name,
        ProductPrice $price,
        ProductStock $stock,
        ShopId $shopId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->shopId = $shopId;
    }

    /**
     * @return ProductId
     */
    public function getId(): ProductId
    {
        return $this->id;
    }

    /**
     * @return ProductName
     */
    public function getName(): ProductName
    {
        return $this->name;
    }

    /**
     * @return ProductPrice
     */
    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    /**
     * @return ProductStock
     */
    public function getStock(): ProductStock
    {
        return $this->stock;
    }

    /**
     * @return ShopId
     */
    public function getShopId(): ShopId
    {
        return $this->shopId;
    }
}
