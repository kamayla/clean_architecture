<?php

namespace Tests\Infrastructure\EloquentRepository;

use App\Product;
use App\Shop;
use Illuminate\Support\Str;
use Packages\Domain\Models\Product\ProductEntity;
use Packages\Domain\Models\Product\ProductId;
use Packages\Domain\Models\Product\ProductName;
use Packages\Domain\Models\Product\ProductPrice;
use Packages\Domain\Models\Product\ProductStock;
use Packages\Domain\Models\Shop\ShopId;
use Packages\Infrastructure\EloquentRepository\ProductEloquentRepository;
use Tests\TestCase;
use Packages\Domain\CommonRepository\UuidGeneratorInterface;

class ProductEloquentRepositoryTest extends TestCase
{
    public function testCreate()
    {
        $shop = factory(Shop::class)->create();

        /** @var ProductEloquentRepository $repository */
        $repository = app(ProductEloquentRepository::class);

        /** @var UuidGeneratorInterface $uuidGenerator */
        $uuidGenerator = app(UuidGeneratorInterface::class);

        $productEntity = new ProductEntity(
            ProductId::create($uuidGenerator->generateUuidString()),
            ProductName::create('エッチな本'),
            ProductPrice::create(30000),
            ProductStock::create(999),
            ShopId::create($shop->id)
        );

        $response = $repository->create($productEntity);

        $this->assertSame(
            Product::find($response->getId()->value())->name,
            $response->getName()->value()
        );
    }
}
