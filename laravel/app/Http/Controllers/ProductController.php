<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Packages\UseCase\Product\Create\ProductCreateUseCaseInterface;
use Packages\UseCase\Product\Create\ProductCreateRequest;

class ProductController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/product",
     *     tags={"User/Product"},
     *     description="Productを作成",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Product名",
     *                     type="string",
     *                     default="花びら大回転"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="価格",
     *                     type="integer",
     *                     default="0"
     *                 ),
     *                 @OA\Property(
     *                     property="stock",
     *                     description="在庫",
     *                     type="integer",
     *                     default="0"
     *                 ),
     *                 @OA\Property(
     *                     property="shop_id",
     *                     description="shopのID",
     *                     type="string",
     *                     default=""
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="作成したShopのオブジェクト",
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function store(
        Request $request,
        ProductCreateUseCaseInterface $createUseCase
    ): JsonResponse {
        $productCreateRequest = new ProductCreateRequest(
            $request->name,
            $request->price,
            $request->stock,
            $request->shop_id
        );

        $response = $createUseCase($productCreateRequest);

        return response()->json(
            $response->toArray(),
            201
        );
    }
}
