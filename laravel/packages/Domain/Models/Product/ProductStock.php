<?php


namespace Packages\Domain\Models\Product;

class ProductStock
{
    /** @var int */
    private $_value;

    private function __construct(int $value)
    {
        $this->_value = $value;
    }

    public static function create(int $value): ProductStock
    {
        return new ProductStock($value);
    }

    public function value(): int
    {
        return $this->_value;
    }

    private function isValid(): bool
    {
        // ここに値のルールを記述
    }
}
