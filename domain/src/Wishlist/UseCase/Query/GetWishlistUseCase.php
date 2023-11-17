<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query;

use Domain\Wishlist\Port\Query\GetWishlistInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class GetWishlistUseCase implements GetWishlistInterface
{
    public function __construct(private WishlistQueryRepositoryInterface $wishlistQueryRepository)
    {
    }

    public function execute(GetWishlistRequest $request): WishlistResponse
    {
        return $this->wishlistQueryRepository->get($request);
    }
}
