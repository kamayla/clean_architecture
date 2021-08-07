<?php


namespace Packages\Domain\Models\Shop;

use App\Shop;
use Packages\Domain\Models\User\UserId;

class ShopEntityFactory
{
    public static function createFromORM(Shop $shop): ShopEntity
    {
        return new ShopEntity(
            ShopId::create($shop->id),
            ShopName::create($shop->name),
            UserId::create($shop->user_id)
        );
    }
}
