<?php

namespace Packages\Infrastructure\EloquentRepository;

use App\Shop;
use Packages\Domain\Models\Shop\ShopEntity;
use Packages\Domain\Models\Shop\ShopEntityFactory;
use Packages\Domain\Models\Shop\ShopId;
use Packages\Domain\Models\Shop\ShopRepository;

class ShopEloquentRepository implements ShopRepository
{

    public function create(ShopEntity $shopEntity): ShopEntity
    {
        $shop = Shop::create([
            'id' => $shopEntity->getId()->value(),
            'name' => $shopEntity->getName()->value(),
            'user_id' => $shopEntity->getUserId()->value(),
        ]);

        return ShopEntityFactory::createFromORM($shop);
    }

    public function getById(ShopId $shopId): ShopEntity
    {
        $shop = Shop::find($shopId->value());

        return ShopEntityFactory::createFromORM($shop);
    }
}
