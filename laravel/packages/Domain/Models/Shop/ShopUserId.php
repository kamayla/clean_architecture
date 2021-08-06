<?php


namespace Packages\Domain\Models\Shop;

class ShopUserId
{
    /**
     * @var string
     */
    private $_value;

    /**
     * ShopUserId constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    /**
     * @param string $value
     * @return ShopUserId
     */
    public static function create(string $value): ShopUserId
    {
        return new ShopUserId($value);
    }

    /**
     * @return int
     */
    public function value(): string
    {
        return $this->_value;
    }
}
