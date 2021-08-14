<?php


namespace Packages\Infrastructure\ExtarnalServiceRepository\Stripe;


use App\User;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Laravel\Cashier\Exceptions\PaymentFailure;
use Packages\Domain\Models\User\UserEntityFactory;
use Packages\Domain\Models\Payment\Amount;
use Packages\Domain\Models\Payment\PaymentMethodId;
use Packages\Domain\Models\Payment\CardToken;

/**
 * Class Test
 * TODO:実行テストをやりやすくするためのものなので後で消すクラス
 *
 * @package Packages\Infrastructure\ExtarnalServiceRepository\Stripe
 */
class Test
{
    public function execute()
    {
        /** @var StripeRepository $c */
        $c = app(StripeRepository::class);

        /** @var User $user */
        $user = User::find('941fbde7-fc00-4883-8ef4-0d5aed5c3307');

//        $user->updateStripeCustomer(['source' => 'tok_1JOBGWHxF6stl85pk9zBYDOC']);

        $paymentMethod = $user->defaultPaymentMethod();


        try {
            $user->charge(300, $paymentMethod->id, ['off_session' => true]);
        } catch (\Exception $e) {
            dd($e->getDeclineCode());
        }
//        $user->updateDefaultPaymentMethod('pm_1JOBjGHxF6stl85pUlHCpna4');

        // TODO: このメソッドに変更したほうがいいかもしれん。
        $user->createAsStripeCustomer([
            'payment_method' => 'pm_1JOApvHxF6stl85pDokxQXWB',
            'invoice_settings' => [
                'default_payment_method' => 'pm_1JOApvHxF6stl85pDokxQXWB'
            ]
        ]);
    }
}
