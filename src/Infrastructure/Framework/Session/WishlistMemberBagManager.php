<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Session;

use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class WishlistMemberBagManager implements GetClaimantWishlistMemberIdInterface
{
    private WishlistMemberBagInterface $wishlistMemberBag;

    /**
     * @throws \Exception
     */
    public function __construct(RequestStack $requestStack)
    {
        $wishlistMemberBag = $requestStack->getSession()->getBag(WishlistMemberBag::NAME);

        if(!$wishlistMemberBag instanceof WishlistMemberBagInterface) {
            throw new \Exception('Wishlist Member bag is not instantiate');
        }

        $this->wishlistMemberBag = $wishlistMemberBag;
    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberBag->getWishlistMemberId();
    }

    public function setWishlistMemberId(string $wishlistMemberId): void
    {
        $this->wishlistMemberBag->setWishlistMemberId($wishlistMemberId);
    }
}
