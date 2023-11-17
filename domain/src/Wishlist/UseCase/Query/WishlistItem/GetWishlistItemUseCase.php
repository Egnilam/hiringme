<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query\WishlistItem;

use Domain\Wishlist\Port\Query\WishlistItem\GetWishlistItemInterface;
use Domain\Wishlist\Repository\Query\WishlistItemQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistItem\GetWishlistItemRequest;
use Domain\Wishlist\Response\WishlistItemResponse;

final readonly class GetWishlistItemUseCase implements GetWishlistItemInterface
{
    public function __construct(private WishlistItemQueryRepositoryInterface $wishlistItemQueryRepository)
    {
    }

    public function execute(GetWishlistItemRequest $request): WishlistItemResponse
    {
        return $this->wishlistItemQueryRepository->get($request);
    }
}
