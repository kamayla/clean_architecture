<?php


namespace Packages\Domain\Models\Shop;

use RuntimeException;

class ShopName
{
    public const MIN_LENGTH = 4;
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
        self::validation($value);

        return new ShopName($value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->_value;
    }

    /**
     * @param string $value
     */
    private static function validation(string $value): void
    {
        if (mb_strlen($value) < self::MIN_LENGTH) {
            throw new RuntimeException(sprintf('最低文字数は%sです', self::MIN_LENGTH));
        }
    }
}
