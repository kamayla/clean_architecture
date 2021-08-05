<?php


namespace Packages\Domain\Models\User;

use App\User;

/**
 * Class UserEntityFactory
 * UserのEloquentモデルからドメインオブジェクトである
 * UserEntityを生成する処理を担うクラス。
 *
 * @package Packages\Domain\Models\User
 */
class UserEntityFactory
{
    public static function createFromORM(User $user): UserEntity
    {
        return new UserEntity(
            UserId::create($user->id),
            UserName::create($user->name),
            UserEmail::create($user->email)
        );
    }
}
