<?php

namespace Packages\Application\User;

use Illuminate\Support\Str;
use Packages\Domain\Models\User\AuthUserEntity;
use Packages\Domain\Models\User\UserEmail;
use Packages\Domain\Models\User\UserId;
use Packages\Domain\Models\User\UserName;
use Packages\Domain\Models\User\UserPassword;
use Packages\Domain\Models\User\UserRepository;
use Packages\UseCase\User\Create\UserCreateRequest;
use Packages\UseCase\User\Create\UserCreateResponse;
use Packages\UseCase\User\Create\UserCreateUseCaseInterface;

class UserCreateInteractor implements UserCreateUseCaseInterface
{
    /** @var UserRepository  */
    private $userRepository;

    /**
     * UserCreateInteractor constructor.
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function __invoke(UserCreateRequest $request): UserCreateResponse
    {
        // Userのドメインモデルを生成
        // この時、全ての値の審査も行われる
        $user = new AuthUserEntity(
            UserId::create(Str::orderedUuid()->toString()),
            UserName::create($request->getName()),
            UserEmail::create($request->getEmail()),
            UserPassword::create($request->getPassword())
        );

        // Repositoryに投げて永続化
        $user = $this->userRepository->create($user);

        // レスポンスとして返却する公開情報はResponseクラスで指定
        return new UserCreateResponse(
            $user->getId()->value(),
            $user->getName()->value(),
            $user->getEmail()->value()
        );
    }
}
