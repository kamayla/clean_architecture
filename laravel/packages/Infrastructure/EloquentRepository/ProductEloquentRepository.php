<?php


namespace Packages\Infrastructure\EloquentRepository;

use App\Product;
use Packages\Domain\Models\Product\ProductEntity;
use Packages\Domain\Models\Product\ProductRepository;
use Packages\Domain\Models\Product\ProductEntityFactory;

class ProductEloquentRepository implements ProductRepository
{
    public function create(ProductEntity $productEntity): ProductEntity
    {
        $product = Product::create([
            'id' => $productEntity->getId()->value(),
            'name' => $productEntity->getName()->value(),
            'price' => $productEntity->getPrice()->value(),
            'stock' => $productEntity->getStock()->value(),
            'shop_id' => $productEntity->getShopId()->value(),
        ]);

        return ProductEntityFactory::createFromORM($product);
    }
}
