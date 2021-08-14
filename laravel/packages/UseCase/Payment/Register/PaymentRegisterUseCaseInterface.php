<?php


namespace Packages\UseCase\Payment\Register;

interface PaymentRegisterUseCaseInterface
{
    public function __invoke(PaymentRegisterRequest $request): PaymentRegisterResponse;
}
