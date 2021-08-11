<?php

namespace Packages\Domain\Models\Shop;

interface ShopRepository
{
    public function create(ShopEntity $shopEntity): ShopEntity;

    public function getById(ShopId $shopId): ShopEntity;
}
