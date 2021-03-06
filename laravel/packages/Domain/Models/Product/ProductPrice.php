<?php


namespace Packages\Domain\Models\Product;

class ProductPrice
{
    /** @var int */
    private $_value;

    private function __construct(int $value)
    {
        $this->_value = $value;
    }

    public static function create(int $value): ProductPrice
    {
        return new ProductPrice($value);
    }

    public function value(): int
    {
        return $this->_value;
    }

    /**
     * @param int $value
     */
    private static function validation(int $value): void
    {
        // ここに値のルールを記述
    }
}
