<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Session;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;

final class WishlistMemberBag extends AttributeBag implements WishlistMemberBagInterface
{
    public const NAME = 'wishlistMember';
    public const STORAGE_KEY = '_wishlist_member';

    public function __construct()
    {
        parent::__construct(self::STORAGE_KEY);
        $this->setName(self::NAME);
    }

    /**
     * @throws \Exception
     */
    public function getWishlistMemberId(): string
    {
        $wishlistMemberId = $this->get('wishlist_member_id');
        if(!is_string($wishlistMemberId)) {
            throw new \Exception('Wishlist member id should be a string');
        }

        return $wishlistMemberId;
    }

    public function setWishlistMemberId(string $wishlistMemberId): void
    {
        $this->set('wishlist_member_id', $wishlistMemberId);
    }
}
