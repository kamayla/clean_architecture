<?php

namespace Packages\Domain\Models\Product;

interface ProductRepository
{
    public function create(ProductEntity $productEntity): ProductEntity;
}
