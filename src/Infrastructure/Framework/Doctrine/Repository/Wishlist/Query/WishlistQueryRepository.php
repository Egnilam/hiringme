<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

final class WishlistQueryRepository extends AbstractRepository implements WishlistQueryRepositoryInterface
{
    /**
     * @return array<WishlistResponse>
     */
    public function get(GetListWishlistRequest $request): array
    {
        $wishlistEntities =  $this->entityManager->getRepository(WishlistEntity::class)->findAll();

        $wishlists = [];
        foreach ($wishlistEntities as $wishlistEntity) {
            $wishlists[] = new WishlistResponse(
                $wishlistEntity->getStringUuid(),
                $wishlistEntity->getWishlistMember()->getStringUuid(),
                $wishlistEntity->getName(),
                [],
                'PUBLIC'
            );
        }

        return $wishlists;
    }
}
