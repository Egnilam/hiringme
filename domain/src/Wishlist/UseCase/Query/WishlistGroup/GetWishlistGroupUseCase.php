<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query\WishlistGroup;

use Domain\Wishlist\Port\Query\WishlistGroup\GetWishlistGroupInterface;
use Domain\Wishlist\Repository\Query\WishlistGroupQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;

final readonly class GetWishlistGroupUseCase implements GetWishlistGroupInterface
{
    public function __construct(private WishlistGroupQueryRepositoryInterface $wishlistGroupQueryRepository)
    {
    }

    public function execute(GetWishlistGroupRequest $request): WishlistGroupResponse
    {
        return $this->wishlistGroupQueryRepository->get($request);
    }
}
