<?php

namespace Packages\Infrastructure\EloquentRepository;

use Packages\Domain\Models\User\UserEntity;
use Packages\Domain\Models\User\AuthUserEntity;
use Packages\Domain\Models\User\UserId;
use Packages\Domain\Models\User\UserRepository;
use Packages\Domain\Models\User\UserEntityFactory;
use App\User;

class UserEloquentRepository implements UserRepository
{

    public function getUserById(string $userId): User
    {
        return User::find($userId);
    }

    public function create(AuthUserEntity $userEntity): UserEntity
    {
        $ormUser = User::create([
            'id' => $userEntity->getId()->value(),
            'name' => $userEntity->getName()->value(),
            'email' => $userEntity->getEmail()->value(),
            'password' => $userEntity->getPassword()->getHashValue(),
        ]);

        return UserEntityFactory::createFromORM($ormUser);
    }

    public function getById(UserId $userId): UserEntity
    {
        $ormUser = User::find($userId->value());

        return UserEntityFactory::createFromORM($ormUser);
    }
}
