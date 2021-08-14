<?php

namespace Packages\Domain\Models\User;

use App\User;

interface UserRepository
{
    /**
     * @param string $userId
     */
    public function getEloquentUserById(string $userId): User;

    /**
     * UserIdでUserをサーチする
     *
     * @param UserId $userId
     * @return UserEntity
     */
    public function getById(UserId $userId): UserEntity;

    /**
     * Userを新規登録する
     *
     * @param AuthUserEntity $userEntity
     * @return UserEntity
     */
    public function create(AuthUserEntity $userEntity): UserEntity;

    /**
     * 認証済みUserを取得する
     *
     * @return UserEntity
     */
    public function getAuthUser(): UserEntity;
}
