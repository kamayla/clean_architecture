<?php


namespace Packages\Domain\Models\Shop;

use App\Shop;

class ShopEntityFactory
{
    public static function createFromORM(Shop $shop): ShopEntity
    {
        return new ShopEntity(
            ShopId::create($shop->id),
            ShopName::create($shop->name),
            ShopUserId::create($shop->user_id)
        );
    }
}
