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

use Packages\Domain\Models\Shop\Specifications\ShopBelongsToAuthUserSpecification;

class ProductCreateInteractor implements ProductCreateUseCaseInterface
{
    /** @var ProductRepository */
    private $productRepository;

    /** @var ShopRepository  */
    private $shopRepository;

    /** @var UuidGeneratorInterface  */
    private $uuidGenerator;

    /** @var ShopBelongsToAuthUserSpecification  */
    private $shopBelongsToAuthUserSpecification;

    public function __construct(
        ProductRepository $productRepository,
        ShopRepository $shopRepository,
        UuidGeneratorInterface $uuidGenerator,
        ShopBelongsToAuthUserSpecification $shopBelongsToAuthUserSpecification
    ) {
        $this->productRepository = $productRepository;
        $this->shopRepository = $shopRepository;
        $this->uuidGenerator = $uuidGenerator;
        $this->shopBelongsToAuthUserSpecification = $shopBelongsToAuthUserSpecification;
    }

    public function __invoke(ProductCreateRequest $request): ProductCreateResponse
    {
        $shopId = ShopId::create($request->getShopId());

        $shopEntity = $this->shopRepository->getById($shopId);

        // Shopが当リクエストの認証ユーザーの持ち物かを審査
        if (!$this->shopBelongsToAuthUserSpecification->isAuthUsersShop($shopEntity)) {
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
