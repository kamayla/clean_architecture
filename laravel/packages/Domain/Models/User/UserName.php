<?php


namespace Packages\Domain\Models\User;

use RuntimeException;

/**
 * Class UserName
 * Userの氏名を表すValueObject
 * @package Packages\Domain\Models\User
 */
class UserName
{
    public const MIN_LNEGTH = 3;

    /** @var string */
    private $_value;

    /**
     * UserId constructor.
     * @param string $userName
     */
    private function __construct(string $userName)
    {
        self::validation($userName);

        $this->_value = $userName;
    }

    public static function create(string $userName): self
    {
        return new self($userName);
    }

    public function value(): string
    {
        return $this->_value;
    }

    private static function validation(string $value): void
    {
        if (mb_strlen($value) < self::MIN_LNEGTH) {
            throw new RuntimeException(sprintf('名前の最小文字数は%sです', self::MIN_LNEGTH));
        }
    }
}
