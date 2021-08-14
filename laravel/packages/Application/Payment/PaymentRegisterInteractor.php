<?php


namespace Packages\Application\Payment;

use Packages\Domain\Models\Payment\CardToken;
use Packages\Domain\Models\Payment\PaymentRepository;
use Packages\Domain\Models\User\UserRepository;
use Packages\UseCase\Payment\Register\PaymentRegisterRequest;
use Packages\UseCase\Payment\Register\PaymentRegisterResponse;
use Packages\UseCase\Payment\Register\PaymentRegisterUseCaseInterface;

/**
 * Class PaymentRegisterInteractor
 *
 * Userの決済アカウントをクレジットカード情報と共に新規作成する
 *
 * @package Packages\Application\Payment
 */
class PaymentRegisterInteractor implements PaymentRegisterUseCaseInterface
{
    /** @var PaymentRepository  */
    private $paymentRepository;

    /** @var UserRepository  */
    private $userRepository;

    public function __construct(PaymentRepository $paymentRepository, UserRepository $userRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->userRepository = $userRepository;
    }

    public function __invoke(PaymentRegisterRequest $request): PaymentRegisterResponse
    {
        $cardToken = CardToken::create($request->getCardToken());

        $authUserEntity = $this->userRepository->getAuthUser();

        $this->paymentRepository->setPaymentAcount($authUserEntity, $cardToken);

        return new PaymentRegisterResponse();
    }
}
