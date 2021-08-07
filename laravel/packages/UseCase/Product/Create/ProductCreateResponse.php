<?php


namespace Packages\UseCase\Product\Create;


class ProductCreateResponse
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var int */
    private $price;

    /** @var int */
    private $stock;

    /** @var string */
    private $shopId;

    /**
     * ProductCreateResponse constructor.
     *
     * @param string $id
     * @param string $name
     * @param int $price
     * @param int $stock
     * @param string $shopId
     */
    public function __construct(
        string $id,
        string $name,
        int $price,
        int $stock,
        string $shopId
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->shopId = $shopId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * 今回JsonAPIだけしか想定してないため、余分なプレゼンターなどを作らず
     * Responseクラスから直接toArrayで公開する。
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->name,
            'stock' => $this->stock,
            'shop_id' => $this->shopId,
        ];
    }
}
