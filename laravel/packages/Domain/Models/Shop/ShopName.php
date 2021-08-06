<?php


namespace Packages\Domain\Models\Shop;

class ShopName
{
    /**
     * @var string
     */
    private $_value;

    /**
     * ShopName constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    /**
     * @param string $value
     * @return ShopName
     */
    public static function create(string $value): ShopName
    {
        return new ShopName($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->_value;
    }
}
