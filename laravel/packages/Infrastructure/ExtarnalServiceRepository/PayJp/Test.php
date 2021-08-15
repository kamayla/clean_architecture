<?php


namespace Packages\Infrastructure\ExtarnalServiceRepository\PayJp;


use App\User;
use Packages\Domain\Models\User\UserEntityFactory;
use Packages\Domain\Models\Payment\Amount;
use Packages\Domain\Models\Payment\PaymentMethodId;
use Packages\Domain\Models\Payment\CardToken;

/**
 * Class Test
 * TODO:実行テストをやりやすくするためのものなので後で消すクラス
 *
 * @package Packages\Infrastructure\ExtarnalServiceRepositor\PayJp
 */
class Test
{
    public function execute()
    {
        /** @var PayJpRepository $c */
        $c = app(PayJpRepository::class);

        /** @var User $user */
        $user = User::find('941fbde7-fc00-4883-8ef4-0d5aed5c3307');

        $userEntity = UserEntityFactory::createFromORM($user);

        $cardToken = CardToken::create('tok_fecc0d30bd6d44c90f635c416039');

        $c->updatePaymentMethod($userEntity, $cardToken);
    }
}
