<?php


namespace Packages\Domain\Models\Payment;

use RuntimeException;

class Amount
{
    /** @var int */
    private $_value;

    private function __construct(int $value)
    {
        $this->_value = $value;
    }

    public static function create(int $value): Amount
    {
        self::validation($value);

        return new Amount($value);
    }

    public function value(): int
    {
        return $this->_value;
    }

    private static function validation(int $value): void
    {
        // ここに値のルールを記述
    }
}
