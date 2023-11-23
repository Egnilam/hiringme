<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query;

use Domain\Wishlist\Port\Query\GetWishlistInterface;
use Domain\Wishlist\Repository\Query\WishlistBasketItemQueryRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Request\Query\WishlistBasketItem\GetWishlistBasketItemRequest;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class GetWishlistUseCase implements GetWishlistInterface
{
    public function __construct(
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
        private WishlistBasketItemQueryRepositoryInterface $wishlistItemBasketQueryRepository
    ) {
    }

    public function execute(GetWishlistRequest $request): WishlistResponse
    {
        $wishlistResponse = $this->wishlistQueryRepository->get($request);
        foreach ($wishlistResponse->getItems() as $item){
            $basketItems = $this->wishlistItemBasketQueryRepository->get(new GetWishlistBasketItemRequest($item->getId()));
            $item->attachBasketItems($basketItems);
        }

        return $wishlistResponse;
    }
}
