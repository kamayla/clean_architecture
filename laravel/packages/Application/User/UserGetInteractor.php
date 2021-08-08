<?php

namespace Packages\Application\User;

use Packages\Domain\Models\User\UserId;
use Packages\Domain\Models\User\UserRepository;
use Packages\UseCase\User\Get\UserGetRequest;
use Packages\UseCase\User\Get\UserGetResponse;
use Packages\UseCase\User\Get\UserGetUseCaseInterface;

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
        $userEntity = $this->userRepository->getById(UserId::create($request->getid()));

        return new UserGetResponse(
            $userEntity->getId()->value(),
            $userEntity->getName()->value(),
            $userEntity->getEmail()->value()
        );
    }
}
