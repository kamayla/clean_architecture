<?php


namespace Packages\UseCase\User\Get;

interface UserGetUseCaseInterface
{
    public function __invoke(UserGetRequest $request): UserGetResponse;
}
