<?php


namespace Packages\Domain\Models\Product;

use RuntimeException;

class ProductName
{
    public const MAX_LENGTH = 10;

    /** @var string */
    private $_value;

    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    public static function create(string $value): ProductName
    {
        self::validation($value);

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
        if (mb_strlen($value) > self::MAX_LENGTH) {
            throw new RuntimeException(sprintf('最大文字数は%sです。', self::MAX_LENGTH));
        }
    }
}
