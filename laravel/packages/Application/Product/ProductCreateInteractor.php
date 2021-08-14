<?php


namespace Packages\Application\Product;

use Packages\Domain\CommonRepository\UuidGeneratorInterface;
use Packages\Domain\Models\User\UserRepository;
use Packages\UseCase\Product\Create\ProductCreateRequest;
use Packages\UseCase\Product\Create\ProductCreateResponse;
use Packages\UseCase\Product\Create\ProductCreateUseCaseInterface;
use Packages\Domain\Models\Product\ProductRepository;
use Packages\Domain\Models\Product\ProductEntity;
use Packages\Domain\Models\Product\ProductId;
use Packages\Domain\Models\Product\ProductName;
use Packages\Domain\Models\Product\ProductPrice;
use Packages\Domain\Models\Product\ProductStock;
use Packages\Domain\Models\Shop\ShopId;
use Packages\Domain\Models\User\UserId;
use RuntimeException;
use Packages\Domain\Models\Shop\ShopRepository;

class ProductCreateInteractor implements ProductCreateUseCaseInterface
{
    /** @var ProductRepository */
    private $productRepository;

    /** @var ShopRepository  */
    private $shopRepository;

    /** @var UserRepository */
    private $userRepository;

    /** @var UuidGeneratorInterface  */
    private $uuidGenerator;

    public function __construct(
        ProductRepository $productRepository,
        ShopRepository $shopRepository,
        UserRepository $userRepository,
        UuidGeneratorInterface $uuidGenerator
    ) {
        $this->productRepository = $productRepository;
        $this->shopRepository = $shopRepository;
        $this->userRepository = $userRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(ProductCreateRequest $request): ProductCreateResponse
    {
        $shopId = ShopId::create($request->getShopId());

        $shopEntity = $this->shopRepository->getById($shopId);

        $authUserEntity = $this->userRepository->getAuthUser();

        // Shopが当リクエストの認証ユーザーの持ち物かを審査
        // TODO:ここはSpecificationに以降すべきか検討
        if ($shopEntity->getUserId()->isEqual($authUserEntity->getId())) {
            throw new RuntimeException('このShopは貴方のものではありません。');
        }

        $productEntity = new ProductEntity(
            ProductId::create($this->uuidGenerator->generateUuidString()),
            ProductName::create($request->getName()),
            ProductPrice::create($request->getPrice()),
            ProductStock::create($request->getStock()),
            ShopId::create($request->getShopId())
        );

        $response = $this->productRepository->create($productEntity);

        return new ProductCreateResponse(
            $response->getId()->value(),
            $response->getName()->value(),
            $response->getPrice()->value(),
            $response->getStock()->value(),
            $response->getShopId()->value()
        );
    }
}
