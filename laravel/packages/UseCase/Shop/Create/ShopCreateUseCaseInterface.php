<?php


namespace Packages\UseCase\Shop\Create;

interface ShopCreateUseCaseInterface
{
    public function __invoke(ShopCreateRequest $request): ShopCreateResponse;
}
