<?php

namespace Packages\Domain\Models\User;

use App\User;

interface UserRepository
{
    /**
     * @param string $userId
     */
    public function getEloquentUserById(string $userId): User;

    public function getById(UserId $userId): UserEntity;

    public function create(AuthUserEntity $userEntity): UserEntity;
}
