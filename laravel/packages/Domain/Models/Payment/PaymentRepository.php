<?php


namespace Packages\Domain\Models\Payment;

use Packages\Domain\Models\User\UserEntity;

interface PaymentRepository
{
    /**
     * カード決済プラットフォームのアカウント作成と共にクレカを登録する。
     *
     * @param UserEntity $userEntity 登録する対象User
     * @param CardToken $cardToken クレカ情報を抽象化したトークン
     */
    public function setPaymentAcount(UserEntity $userEntity, CardToken $cardToken): void;

    /**
     * クレカの登録を変更する。
     *
     * @param UserEntity $userEntity 登録する対象User
     * @param CardToken $cardToken クレカ情報を抽象化したトークン
     */
    public function updatePaymentMethod(UserEntity $userEntity, CardToken $cardToken): void;

    /**
     * 決済を実行する。
     *
     * @param UserEntity $userEntity 支払いをする対象User
     * @param Amount $amount 支払金額
     */
    public function executeCharge(UserEntity $userEntity, Amount $amount): void;

    /**
     * 登録されているクレカの一覧を取得する。
     *
     * @param UserEntity $userEntity 対象のUser
     * @return PaymentMethodId[] クレカを抽象化したIDの配列
     */
    public function getPaymentMethods(UserEntity $userEntity): array;

    /**
     * クレカを追加する。
     *
     * @param UserEntity $userEntity 対象のUser
     * @param PaymentMethodId $paymentMethodId 追加したいクレカのID
     */
    public function addPaymentMethod(UserEntity $userEntity, PaymentMethodId $paymentMethodId): void;

    /**
     * クレカを削除する。
     *
     * @param UserEntity $userEntity 対象User
     * @param PaymentMethodId $paymentMethodId 削除したクレカID
     */
    public function removePaymentMethod(UserEntity $userEntity, PaymentMethodId $paymentMethodId): void;
}
