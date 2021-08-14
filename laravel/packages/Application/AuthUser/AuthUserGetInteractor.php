<?php


namespace Packages\Application\AuthUser;

use Packages\UseCase\AuthUser\Get\AuthUserGetResponse;
use Packages\UseCase\AuthUser\Get\AuthUserGetUseCaseInterface;
use Packages\Domain\Models\User\UserRepository;

class AuthUserGetInteractor implements AuthUserGetUseCaseInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(): AuthUserGetResponse
    {
        $authUserEntity = $this->userRepository->getAuthUser();

        return new AuthUserGetResponse(
            $authUserEntity->getId()->value(),
            $authUserEntity->getName()->value(),
            $authUserEntity->getEmail()->value()
        );
    }
}
