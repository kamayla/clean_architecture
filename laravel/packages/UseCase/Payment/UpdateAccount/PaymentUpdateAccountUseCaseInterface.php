<?php


namespace Packages\UseCase\Payment\UpdateAccount;

interface PaymentUpdateAccountUseCaseInterface
{
    public function __invoke(PaymentUpdateAccountRequest $request): PaymentUpdateAccountResponse;
}
