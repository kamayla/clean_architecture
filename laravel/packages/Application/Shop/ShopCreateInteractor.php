<?php

namespace Packages\Application\Shop;

use Illuminate\Support\Str;
use Packages\Domain\Models\Shop\ShopEntity;
use Packages\Domain\Models\Shop\ShopId;
use Packages\Domain\Models\Shop\ShopName;
use Packages\Domain\Models\Shop\ShopRepository;
use Packages\Domain\Models\User\UserId;
use Packages\UseCase\Shop\Create\ShopCreateRequest;
use Packages\UseCase\Shop\Create\ShopCreateResponse;
use Packages\UseCase\Shop\Create\ShopCreateUseCaseInterface;
use Packages\Domain\CommonRepository\UuidGeneratorInterface;

class ShopCreateInteractor implements ShopCreateUseCaseInterface
{

    /** @var ShopRepository  */
    private $shopRepository;

    /** @var UuidGeneratorInterface */
    private $uuidGenerator;


    /**
     * ShopCreateInteractor constructor.
     */
    public function __construct(ShopRepository $shopRepository, UuidGeneratorInterface $uuidGenerator)
    {
        $this->shopRepository = $shopRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(ShopCreateRequest $request): ShopCreateResponse
    {
        $shopEntity = new ShopEntity(
            ShopId::create($this->uuidGenerator->generateUuidString()),
            ShopName::create($request->getName()),
            UserId::create($request->getUserId())
        );

        $response = $this->shopRepository->create($shopEntity);

        return new ShopCreateResponse(
            $response->getId()->value(),
            $response->getName()->value()
        );
    }
}
