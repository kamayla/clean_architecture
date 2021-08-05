<?php


namespace Packages\Domain\Models\User;

/**
 * Class UserEmail
 * UserのEmailアドレスを表すValueObject
 * @package Packages\Domain\Models\User
 */
class UserEmail
{
    /** @var string */
    private $_value;

    /**
     * UserId constructor.
     * @param string $userEmail
     */
    private function __construct(string $userEmail)
    {
        $this->_value = $userEmail;
    }

    public static function create(string $userEmail): self
    {
        return new self($userEmail);
    }

    public function value(): string
    {
        return $this->_value;
    }
}
