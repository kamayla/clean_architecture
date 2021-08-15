<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Packages\UseCase\Payment\Register\PaymentRegisterRequest;
use Packages\UseCase\Payment\Register\PaymentRegisterUseCaseInterface;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountRequest;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountUseCaseInterface;

class PaymentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/payment/account",
     *     tags={"User/Payment"},
     *     description="pamentのアカウントを作成",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="token",
     *                     description="クレカのトークン",
     *                     type="string",
     *                     default="token"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="",
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function registerCard(
        Request $request,
        PaymentRegisterUseCaseInterface $paymentRegisterUseCase
    ): JsonResponse {
        $paymentRegisterRequest = new PaymentRegisterRequest($request->token);
        $paymentRegisterResponse = $paymentRegisterUseCase($paymentRegisterRequest);

        return response()->json(
            $paymentRegisterResponse->toArray(),
            JsonResponse::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/api/payment/account",
     *     tags={"User/Payment"},
     *     description="pamentのアカウントの更新",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="token",
     *                     description="クレカのトークン",
     *                     type="string",
     *                     default="token"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="",
     *     ),
     *     security={{ "apiAuth": {} }}
     * )
     */
    public function updateCard(
        Request $request,
        PaymentUpdateAccountUseCaseInterface $paymentUpdateAccountUseCase
    ): JsonResponse {
        $paymentUpdateAccountRequest = new PaymentUpdateAccountRequest($request->token);
        $paymentUpdateAccountResponse = $paymentUpdateAccountUseCase($paymentUpdateAccountRequest);

        return response()->json(
            $paymentUpdateAccountResponse->toArray()
        );
    }
}
