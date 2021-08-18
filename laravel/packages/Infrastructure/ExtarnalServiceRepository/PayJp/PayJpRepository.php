<?php


namespace Packages\Infrastructure\ExtarnalServiceRepository\PayJp;

use App\User;
use Packages\Domain\Models\Payment\Amount;
use Packages\Domain\Models\Payment\CardToken;
use Packages\Domain\Models\Payment\PaymentMethodId;
use Packages\Domain\Models\Payment\PaymentRepository;
use Packages\Domain\Models\User\UserEntity;
use Payjp\Charge;
use Payjp\Customer;
use Payjp\Payjp;

class PayJpRepository implements PaymentRepository
{
    /**
     * @param UserEntity $userEntity
     * @param CardToken $cardToken
     */
    public function setPaymentAcount(UserEntity $userEntity, CardToken $cardToken): void
    {
        $user = User::find($userEntity->getId()->value());
        Payjp::setApiKey(config('payjp.secret_key'));

        // 顧客情報登録
        $customer = Customer::create([
            'card' => $cardToken->value(),
            'description' => "userId: {$user->id}, userName: {$user->name}",
        ]);

        // DBにpayjpの顧客idを登録
        $user->payjp_customer_id = $customer->id;
        $user->save();
    }

    /**
     * @param UserEntity $userEntity
     * @param CardToken $cardToken
     */
    public function updatePaymentMethod(UserEntity $userEntity, CardToken $cardToken): void
    {
        Payjp::setApiKey(config('payjp.secret_key'));

        $user = User::find($userEntity->getId()->value());

        $customer = Customer::retrieve($user->payjp_customer_id);
        $customer->card = $cardToken->value();
        $customer = $customer->save();

        // Stripeと違い、自動的にでデフォルトカードが切り替わらないので、
        // ここでデフォルトカードと切り替えている。
        $card = $customer->cards->data[0];
        $customer->default_card = $card->id;
        $customer->save();
    }

    /**
     * @param UserEntity $userEntity
     * @param Amount $amount
     * @param string|null $description
     */
    public function executeCharge(UserEntity $userEntity, Amount $amount, string $description = null): void
    {
        $user = User::find($userEntity->getId()->value());
        Payjp::setApiKey(config('payjp.secret_key'));
        $customer = Customer::retrieve($user->payjp_customer_id);
        Charge::create([
            "customer" => $customer->id,
            "amount" => $amount->value(),
            "currency" => 'jpy',
            'description' => $description
        ]);
    }

    /**
     * @param UserEntity $userEntity
     * @return PaymentMethodId[]
     */
    public function getPaymentMethods(UserEntity $userEntity): array
    {
        // 今回特に使わないので実装しない。
        return [];
    }

    /**
     * @param UserEntity $userEntity
     * @param PaymentMethodId $paymentMethodId
     */
    public function addPaymentMethod(UserEntity $userEntity, PaymentMethodId $paymentMethodId): void
    {
        // 今回特に使わないので実装しない。
    }

    /**
     * @param UserEntity $userEntity
     * @param PaymentMethodId $paymentMethodId
     */
    public function removePaymentMethod(UserEntity $userEntity, PaymentMethodId $paymentMethodId): void
    {
        // 今回特に使わないので実装しない。
    }
}
