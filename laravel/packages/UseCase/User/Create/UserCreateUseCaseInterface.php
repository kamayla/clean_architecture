<?php


namespace Packages\UseCase\User\Create;

interface UserCreateUseCaseInterface
{
    public function __invoke(UserCreateRequest $request): UserCreateResponse;
}
