<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query\WishlistMemberBasket;

use Domain\Wishlist\Port\Query\WishlistMemberBasket\GetWishlistMemberBasketInterface;
use Domain\Wishlist\Repository\Query\WishlistMemberBasketQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\WishlistMemberBasket\GetWishlistMemberBasketRequest;
use Domain\Wishlist\Response\WishlistMemberBasketResponse;

final readonly class GetWishlistMemberBasketUseCase implements GetWishlistMemberBasketInterface
{
    public function __construct(private WishlistMemberBasketQueryRepositoryInterface $wishlistMemberBasketQueryRepository)
    {
    }

    public function execute(GetWishlistMemberBasketRequest $request): WishlistMemberBasketResponse
    {
        return $this->wishlistMemberBasketQueryRepository->get($request);
    }
}
