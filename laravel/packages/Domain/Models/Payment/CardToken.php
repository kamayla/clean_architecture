<?php


namespace Packages\Domain\Models\Payment;

use RuntimeException;

/**
 * Class CardToken
 *
 * フロントエンドから送られてくる、カード情報を抽象化したトークン
 *
 * @package Packages\Domain\Models\Payment
 */
class CardToken
{
    /** @var string */
    private $_value;

    private function __construct(string $value)
    {
        $this->_value = $value;
    }

    public static function create(string $value): CardToken
    {
        self::validation($value);

        return new CardToken($value);
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
