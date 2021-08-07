<?php


namespace Packages\Domain\Models\Product;

use App\Product;
use Packages\Domain\Models\Shop\ShopId;

class ProductEntityFactory
{
    public static function createFromORM(Product $product): ProductEntity
    {
        return new ProductEntity(
            ProductId::create($product->id),
            ProductName::create($product->name),
            ProductPrice::create($product->price),
            ProductStock::create($product->stock),
            ShopId::create($product->shop_id)
        );
    }
}
