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
    public const MIN_LENGTH = 8;

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
        self::validation($userPassword);

        return new self($userPassword);
    }

    public function value(): string
    {
        return $this->_value;
    }

    /**
     * 平文のパスワードをハッシュ化する処理
     *
     * @return string
     */
    public function getHashValue(): string
    {
        return Hash::make($this->_value);
    }

    private static function validation(string $userPassword): void
    {
        if (strlen($userPassword) < self::MIN_LENGTH) {
            throw new RuntimeException(sprintf('パスワードは最低%s文字です。', UserPassword::MIN_LENGTH));
        }
    }
}
