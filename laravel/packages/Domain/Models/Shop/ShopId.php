<?php


namespace Packages\Domain\Models\Shop;

class ShopId
{
    /**
     * @var string
     */
    private $_value;

    /**
     * ShopId constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    /**
     * @param string $value
     * @return ShopId
     */
    public static function create(string $value): ShopId
    {
        return new ShopId($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->_value;
    }
}
