<?php


namespace Packages\Infrastructure\ExtarnalServiceRepository\Stripe;

use App\User;
use Laravel\Cashier\Exceptions\CustomerAlreadyCreated;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Packages\Domain\Models\Payment\Amount;
use Packages\Domain\Models\Payment\CardToken;
use Packages\Domain\Models\Payment\PaymentMethodId;
use Packages\Domain\Models\Payment\PaymentRepository;
use Packages\Domain\Models\User\UserEntity;

class StripeRepository implements PaymentRepository
{
    /**
     * @param UserEntity $userEntity
     * @param CardToken $cardToken
     * @throws CustomerAlreadyCreated
     */
    public function setPaymentAcount(UserEntity $userEntity, CardToken $cardToken): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $user->createAsStripeCustomer([
            'source' => $cardToken->value(),
        ]);
    }

    /**
     * @param UserEntity $userEntity
     * @param CardToken $cardToken
     */
    public function updatePaymentMethod(UserEntity $userEntity, CardToken $cardToken): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $user->updateStripeCustomer([
            'source' => $cardToken->value(),
        ]);
    }

    /**
     * @param UserEntity $userEntity
     * @param Amount $amount
     * @param string|null $description
     * @throws PaymentActionRequired
     * @throws PaymentFailure
     */
    public function executeCharge(UserEntity $userEntity, Amount $amount, string $description = null): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $paymentMethod = $user->defaultPaymentMethod();

        $user->charge(
            $amount->value(),
            $paymentMethod->id,
            [
                'description' => $description
            ]
        );
    }

    /**
     * @param UserEntity $userEntity
     * @return PaymentMethodId[]
     */
    public function getPaymentMethods(UserEntity $userEntity): array
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $paymentMethods = $user->paymentMethods();

        $paymentMehotdIds = [];
        foreach ($paymentMethods as $paymentMethod) {
            $paymentMehotdIds[] = PaymentMethodId::create($paymentMethod->id);
        }

        return $paymentMehotdIds;
    }

    /**
     * @param UserEntity $userEntity
     * @param PaymentMethodId $paymentMethodId
     */
    public function addPaymentMethod(UserEntity $userEntity, PaymentMethodId $paymentMethodId): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $user->addPaymentMethod($paymentMethodId->value());
    }

    /**
     * @param UserEntity $userEntity
     * @param PaymentMethodId $paymentMethodId
     */
    public function removePaymentMethod(UserEntity $userEntity, PaymentMethodId $paymentMethodId): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $user->removePaymentMethod($paymentMethodId->value());
    }
}
