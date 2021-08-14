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
use Packages\Domain\Models\Payment\PaymentRepository;
use Packages\Domain\Models\User\UserRepository;
use Packages\Domain\Models\Payment\Amount;

class ShopCreateInteractor implements ShopCreateUseCaseInterface
{

    /** @var ShopRepository  */
    private $shopRepository;

    /** @var UuidGeneratorInterface */
    private $uuidGenerator;

    /** @var PaymentRepository */
    private $paymentRepository;

    /** @var UserRepository */
    private $userRepository;


    /**
     * ShopCreateInteractor constructor.
     */
    public function __construct(
        ShopRepository $shopRepository,
        UuidGeneratorInterface $uuidGenerator,
        PaymentRepository $paymentRepository,
        UserRepository $userRepository
    ) {
        $this->shopRepository = $shopRepository;
        $this->uuidGenerator = $uuidGenerator;
        $this->paymentRepository = $paymentRepository;
        $this->userRepository = $userRepository;
    }

    public function __invoke(ShopCreateRequest $request): ShopCreateResponse
    {
        // ショップを作成するには初期費用30000円かかるのでその費用を決済
        $this->chargeShopOpenFee();

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

    private function chargeShopOpenFee(): void
    {
        $userEntity = $this->userRepository->getAuthUser();
        $this->paymentRepository->executeCharge($userEntity, Amount::create(30000));
    }
}
