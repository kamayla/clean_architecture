<?php


namespace Packages\UseCase\Payment\Register;


class PaymentRegisterRequest
{
    /** @var string */
    private $cardToken;
    public function __construct(string $cardToken)
    {
        $this->cardToken = $cardToken;
    }

    /**
     * @return string
     */
    public function getCardToken(): string
    {
        return $this->cardToken;
    }
}
