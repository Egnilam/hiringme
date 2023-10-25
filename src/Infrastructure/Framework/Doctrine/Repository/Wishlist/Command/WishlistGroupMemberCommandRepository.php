<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Command;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistGroupMemberEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

class WishlistGroupMemberCommandRepository extends AbstractRepository implements WishlistGroupMemberCommandRepositoryInterface
{

    public function create(CreateWishlistGroupMemberRequest $request): void
    {
        $wishlistGroupMember = new WishlistGroupMemberEntity();
        $wishlistGroupMember
            ->setPseudonym($request->getPseudonym());

        $this->entityManager->persist($wishlistGroupMember);
    }
}