<?php

namespace Packages\Application\Shop;

use Illuminate\Support\Str;
use Packages\Domain\Models\Shop\ShopEntity;
use Packages\Domain\Models\Shop\ShopId;
use Packages\Domain\Models\Shop\ShopName;
use Packages\Domain\Models\Shop\ShopRepository;
use Packages\Domain\Models\Shop\ShopUserId;
use Packages\UseCase\Shop\Create\ShopCreateRequest;
use Packages\UseCase\Shop\Create\ShopCreateResponse;
use Packages\UseCase\Shop\Create\ShopCreateUseCaseInterface;

class ShopCreateInteractor implements ShopCreateUseCaseInterface
{

    private $shopRepository;


    /**
     * ShopCreateInteractor constructor.
     */
    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    public function __invoke(ShopCreateRequest $request): ShopCreateResponse
    {
        $shopEntity = new ShopEntity(
            ShopId::create(Str::orderedUuid()->toString()),
            ShopName::create($request->getName()),
            ShopUserId::create($request->getUserId())
        );

        $response = $this->shopRepository->create($shopEntity);

        return new ShopCreateResponse(
            $response->getId()->value(),
            $response->getName()->value()
        );
    }
}
