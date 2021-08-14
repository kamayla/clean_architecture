<?php


namespace Packages\UseCase\AuthUser\Get;

interface AuthUserGetUseCaseInterface
{
    public function __invoke(): AuthUserGetResponse;
}
