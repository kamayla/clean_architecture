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

class ProductCreateInteractor implements ProductCreateUseCaseInterface
{
    /** @var ProductRepository */
    private $productRepository;

    /** @var UuidGeneratorInterface  */
    private $uuidGenerator;

    public function __construct(ProductRepository $productRepository, UuidGeneratorInterface $uuidGenerator)
    {
        $this->productRepository = $productRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    public function __invoke(ProductCreateRequest $request): ProductCreateResponse
    {
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
