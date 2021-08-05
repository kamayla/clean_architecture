<?php


namespace Packages\Domain\Models\User;

/**
 * Class AuthUserEntity
 * 認証関連用のUserEntity
 * @package Packages\Domain\Models\User
 */
class AuthUserEntity extends UserEntity
{
    /** @var UserPassword */
    private $password;

    public function __construct(UserId $id, UserName $name, UserEmail $email, UserPassword $password)
    {
        parent::__construct($id, $name, $email);
        $this->password = $password;
    }

    /**
     * @return UserPassword
     */
    public function getPassword(): UserPassword
    {
        return $this->password;
    }

}
