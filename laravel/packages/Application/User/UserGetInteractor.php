<?php

namespace Packages\Application\User;

use Illuminate\Support\Str;
use Packages\UseCase\User\Get\UserGetRequest;
use Packages\UseCase\User\Get\UserGetResponse;
use Packages\UseCase\User\Get\UserGetUseCaseInterface;
use Packages\Domain\Models\User\UserEntity;
use Packages\Domain\Models\User\UserId;
use Packages\Domain\Models\User\UserName;
use Packages\Domain\Models\User\UserPassword;
use Packages\Domain\Models\User\UserEmail;
use Packages\Domain\Models\User\UserRepository;

class UserGetInteractor implements UserGetUseCaseInterface
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

    public function __invoke(UserGetRequest $request): UserGetResponse
    {

    }
}
