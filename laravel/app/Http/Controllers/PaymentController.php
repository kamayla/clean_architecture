<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Packages\UseCase\Payment\Register\PaymentRegisterUseCaseInterface;
use Packages\UseCase\Payment\Register\PaymentRegisterRequest;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountRequest;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountUseCaseInterface;

class PaymentController extends Controller
{
    public function registerCard(Request $request, PaymentRegisterUseCaseInterface $paymentRegisterUseCase)
    {
        $paymentRegisterRequest = new PaymentRegisterRequest($request->token);

        $paymentRegisterUseCase($paymentRegisterRequest);
    }

    public function updateCard(Request $request, PaymentUpdateAccountUseCaseInterface $paymentUpdateAccountUseCase)
    {
        $paymentUpdateAccountRequest = new PaymentUpdateAccountRequest($request->token);

        $paymentUpdateAccountUseCase($paymentUpdateAccountRequest);
    }
}
