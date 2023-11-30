<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query;

use Domain\Wishlist\Port\Query\GetWishlistInterface;
use Domain\Wishlist\Repository\Query\WishlistBasketItemQueryRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Request\Query\WishlistBasketItem\GetWishlistBasketItemRequest;
use Domain\Wishlist\Response\WishlistResponse;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;

final readonly class GetWishlistUseCase implements GetWishlistInterface
{
    public function __construct(
        private GetClaimantWishlistMemberIdInterface $getClaimantWishlistMemberId,
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
        private WishlistBasketItemQueryRepositoryInterface $wishlistItemBasketQueryRepository
    ) {
    }

    public function execute(GetWishlistRequest $request): WishlistResponse
    {
        $claimantWishlistMemberId = $this->getClaimantWishlistMemberId->get();

        $wishlistResponse = $this->wishlistQueryRepository->get($request, $claimantWishlistMemberId);

        $this->loadBasketItems($wishlistResponse, $request);

        return $wishlistResponse;
    }

    private function loadBasketItems(WishlistResponse $wishlistResponse, GetWishlistRequest $request): void
    {

        if(
            $request->hasOption(GetWishlistRequest::OPT_ITEMS_LOAD_BASKET_ITEMS)
            && $request->getOptionValue(GetWishlistRequest::OPT_ITEMS_LOAD_BASKET_ITEMS)
        ) {
            foreach ($wishlistResponse->getItems() as $item) {
                $basketItems = $this->wishlistItemBasketQueryRepository->get(
                    new GetWishlistBasketItemRequest(
                        $item->getId(),
                    )
                );
                $item->attachBasketItems($basketItems);
            }
        }
    }
}
