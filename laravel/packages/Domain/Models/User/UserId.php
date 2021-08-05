<?php


namespace Packages\Domain\Models\User;

/**
 * Class UserId
 * Uesrの識別子であるIDを表すValueObject
 * @package Packages\Domain\Models\User
 */
class UserId
{
    /** @var string */
    private $_value;

    /**
     * UserId constructor.
     * @param string $userId
     */
    private function __construct(string $userId)
    {
        $this->_value = $userId;
    }

    public static function create(string $userId): self
    {
        return new self($userId);
    }

    public function value(): string
    {
        return $this->_value;
    }
}