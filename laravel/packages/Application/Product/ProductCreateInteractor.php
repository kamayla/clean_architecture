<?php


namespace Packages\Application\Product;

use Packages\Domain\CommonRepository\UuidGeneratorInterface;
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

    /** @var UuidGeneratorInterface  */
    private $uuidGenerator;

    public function __construct(
        ProductRepository $productRepository,
        ShopRepository $shopRepository,
        UuidGeneratorInterface $uuidGenerator
    ) {
        $this->productRepository = $productRepository;
        $this->shopRepository = $shopRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(ProductCreateRequest $request): ProductCreateResponse
    {
        $shopId = ShopId::create($request->getShopId());
        $userId = UserId::create($request->getUserId());


        $shopEntity = $this->shopRepository->getById($shopId);

        // Shopが当リクエストのUserIdの所有物か確認している
        if ($shopEntity->getUserId()->isEquals($userId)) {
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
