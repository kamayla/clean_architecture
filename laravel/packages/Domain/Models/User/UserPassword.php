<?php


namespace Packages\Domain\Models\User;

// TODO:ここでLaravelのファサードに依存してしまうのはあまり良くないので解決策を考える。
use Illuminate\Support\Facades\Hash;
use RuntimeException;

/**
 * Class UserPassword
 * Userのパスワードを示すValueObject
 * @package Packages\Domain\Models\User
 */
class UserPassword
{
    public const MIN_LENGTH = 10;

    /** @var string */
    private $_value;

    /**
     * UserId constructor.
     * @param string $userPassword
     */
    private function __construct(string $userPassword)
    {
        $this->_value = $userPassword;
    }

    public static function create(string $userPassword): self
    {
        if (! self::isValid($userPassword)) {
            throw new RuntimeException('パスワードは最低10文字です');
        }
        return new self($userPassword);
    }

    public function value(): string
    {
        return $this->_value;
    }

    public function getHashValue(): string
    {
        return Hash::make($this->_value);
    }

    private static function isValid(string $userPassword): bool
    {
        // TODO:ルールがザルなのであとで考える
        if (strlen($userPassword) < self::MIN_LENGTH) return false;

        return true;
    }
}
