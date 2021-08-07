<?php

namespace Tests\Application\Product;

use Packages\Application\Product\ProductCreateInteractor;
use Packages\UseCase\Product\Create\ProductCreateRequest;
use Tests\TestCase;
use App\Shop;

class ProductCreateInteractorTest extends TestCase
{

    public function test__invoke()
    {
        $shop = factory(Shop::class)->create();
        $request = new ProductCreateRequest(
            'hogehoge',
            300,
            400,
            $shop->id
        );

        $interactor = app(ProductCreateInteractor::class);
        $resopnse = $interactor($request);

        $this->assertSame($request->getName(), $resopnse->getName());
    }
}
