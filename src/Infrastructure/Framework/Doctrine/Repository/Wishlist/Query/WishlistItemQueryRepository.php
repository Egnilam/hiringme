<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\WishlistItemEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Repository\Query\WishlistItemQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistItem\GetWishlistItemRequest;
use Domain\Wishlist\Response\WishlistItemResponse;

final class WishlistItemQueryRepository extends AbstractRepository implements WishlistItemQueryRepositoryInterface
{
    public function get(GetWishlistItemRequest $request): WishlistItemResponse
    {
        $wishlistItemEntity = $this->entityManager->getRepository(WishlistItemEntity::class)
            ->findOneBy(['uuid' => $request->getId()]);

        if(!$wishlistItemEntity) {
            throw new NotFoundException();
        }

        return new WishlistItemResponse(
            $wishlistItemEntity->getStringUuid(),
            $wishlistItemEntity->getLabel(),
            $wishlistItemEntity->getLink(),
            $wishlistItemEntity->getDescription(),
            $wishlistItemEntity->getPriority(),
            $wishlistItemEntity->getPrice()
        );
    }
}
