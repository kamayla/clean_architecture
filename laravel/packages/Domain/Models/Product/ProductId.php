<?php


namespace Packages\Domain\Models\Product;

class ProductId
{
    /** @var string */
    private $_value;

    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    public static function create(string $value): ProductId
    {
        return new ProductId($value);
    }

    public function value(): string
    {
        return $this->_value;
    }
}
