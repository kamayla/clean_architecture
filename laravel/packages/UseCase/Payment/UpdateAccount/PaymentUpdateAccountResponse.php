<?php


namespace Packages\UseCase\Payment\UpdateAccount;


class PaymentUpdateAccountResponse
{
    public function __construct()
    {}

    /**
     * 今回JsonAPIだけしか想定してないため、余分なプレゼンターなどを作らず
     * Responseクラスから直接toArrayで公開する。
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'result' => 'success',
        ];
    }
}
