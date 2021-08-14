<?php


namespace Packages\Application\Payment;

use Packages\Domain\Models\Payment\CardToken;
use Packages\Domain\Models\Payment\PaymentRepository;
use Packages\Domain\Models\User\UserRepository;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountRequest;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountResponse;
use Packages\UseCase\Payment\UpdateAccount\PaymentUpdateAccountUseCaseInterface;

class PaymentUpdateAccountInteractor implements PaymentUpdateAccountUseCaseInterface
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

    public function __invoke(PaymentUpdateAccountRequest $request): PaymentUpdateAccountResponse
    {
        $cardToken = CardToken::create($request->getCardToken());

        $authUserEntity = $this->userRepository->getAuthUser();

        $this->paymentRepository->updatePaymentMethod($authUserEntity, $cardToken);

        return new PaymentUpdateAccountResponse();
    }
}
