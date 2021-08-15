<?php


namespace Packages\Domain\Models\Shop\Specifications;

use Packages\Domain\Models\User\UserRepository;
use Packages\Domain\Models\Shop\ShopEntity;

class ShopBelongsToAuthUserSpecification
{
    /** @var UserRepository  */
    private $userRepository;

    /**
     * ShopBelongsToAuthUserSpecification constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * ShopがAuthUserの持ち物かどうかを評価する
     *
     * @param ShopEntity $targetShopEntity
     * @return bool
     */
    public function isAuthUsersShop(ShopEntity $targetShopEntity): bool
    {
        $authUserEntity = $this->userRepository->getAuthUser();

        return $targetShopEntity->getUserId()->isEqual($authUserEntity->getId());
    }
}
