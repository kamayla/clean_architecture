<?php


namespace Packages\UseCase\Product\Create;

interface ProductCreateUseCaseInterface
{
    public function __invoke(ProductCreateRequest $request): ProductCreateResponse;
}
