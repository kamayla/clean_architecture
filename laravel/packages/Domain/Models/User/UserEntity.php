<?php


namespace Packages\Domain\Models\User;

/**
 * Class UserEntity
 * Userを表現するEntity
 * @package Packages\Domain\Models\User
 */
class UserEntity
{
    /** @var UserId */
    protected $id;

    /** @var UserName */
    protected $name;

    /** @var UserEmail */
    protected $email;

    /**
     * UserEntity constructor.
     * @param UserId $id
     * @param UserName $name
     * @param UserEmail $email
     * @param UserPassword $password
     */
    public function __construct(UserId $id, UserName $name, UserEmail $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserName
     */
    public function getName(): UserName
    {
        return $this->name;
    }

    /**
     * @return UserEmail
     */
    public function getEmail(): UserEmail
    {
        return $this->email;
    }
}
