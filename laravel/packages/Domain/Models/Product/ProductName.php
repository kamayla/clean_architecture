<?php


namespace Packages\Domain\Models\Product;

class ProductName
{
    /** @var string */
    private $_value;

    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    public static function create(string $value): ProductName
    {
        return new ProductName($value);
    }

    public function value(): string
    {
        return $this->_value;
    }

    /**
     * @param string $value
     */
    private static function validation(string $value): void
    {
        // ここに値のルールを記述
    }
}
