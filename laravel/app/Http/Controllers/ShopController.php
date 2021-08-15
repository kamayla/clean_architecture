<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Packages\UseCase\Shop\Create\ShopCreateRequest;
use Packages\UseCase\Shop\Create\ShopCreateUseCaseInterface;
use App\Http\Requests\Shop\ShopCreateFormRequest;

class ShopController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/shop",
     *     tags={"User/Shop"},
     *     description="Shopを作成",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="Shop名",
     *                     type="string",
     *                     default="ビンコムセンター"
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
        ShopCreateFormRequest $request,
        ShopCreateUseCaseInterface $shopCreateUseCase
    ): JsonResponse {
        $userId = auth()->id();

        $shopCreateRequest = new ShopCreateRequest(
            $request->name,
            $userId
        );

        $shopCreateResponse = $shopCreateUseCase($shopCreateRequest);

        return response()->json(
            $shopCreateResponse->toArray(),
            JsonResponse::HTTP_CREATED
        );
    }
}
