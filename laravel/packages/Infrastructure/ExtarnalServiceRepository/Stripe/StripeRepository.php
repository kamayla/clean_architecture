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
     */
    public function setPaymentAcount(UserEntity $userEntity, CardToken $cardToken): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        try {
            $user->createAsStripeCustomer([
                'source' => $cardToken->value(),
            ]);
        } catch (CustomerAlreadyCreated $e) {
            report($e);
        }
    }

    /**
     * @param UserEntity $userEntity
     * @param CardToken $cardToken
     */
    public function updatePaymentMethod(UserEntity $userEntity, CardToken $cardToken): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        try {
            $user->updateStripeCustomer([
                'source' => $cardToken->value(),
            ]);
        } catch (CustomerAlreadyCreated $e) {
            report($e);
        }
    }

    /**
     * @param UserEntity $userEntity
     * @param Amount $amount
     */
    public function executeCharge(UserEntity $userEntity, Amount $amount): void
    {
        /** @var User $user */
        $user = User::find($userEntity->getId()->value());

        $paymentMethod = $user->defaultPaymentMethod();

        try {
            $user->charge(
                $amount->value(),
                $paymentMethod->id
            );
        } catch (PaymentActionRequired | PaymentFailure $e) {
            report($e);
        }
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
