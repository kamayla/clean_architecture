<?php


namespace Packages\Domain\Models\User;

/**
 * Class UserName
 * Userの氏名を表すValueObject
 * @package Packages\Domain\Models\User
 */
class UserName
{
    /** @var string */
    private $_value;

    /**
     * UserId constructor.
     * @param string $userName
     */
    private function __construct(string $userName)
    {
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
}
