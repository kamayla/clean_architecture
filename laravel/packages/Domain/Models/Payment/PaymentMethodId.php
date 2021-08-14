<?php


namespace Packages\Domain\Models\Payment;

use RuntimeException;

class PaymentMethodId
{
    /** @var string */
    private $_value;

    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    public static function create(string $value): PaymentMethodId
    {
        self::validation($value);

        return new PaymentMethodId($value);
    }

    public function value(): string
    {
        return $this->_value;
    }

    private static function validation(string $value): void
    {
        // ここに値のルールを記述
    }
}
