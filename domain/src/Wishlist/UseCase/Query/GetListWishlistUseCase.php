<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query;

use Domain\Wishlist\Port\Query\GetListWishlistInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;

final readonly class GetListWishlistUseCase implements GetListWishlistInterface
{
    public function __construct(
        private GetClaimantWishlistMemberIdInterface $getClaimantWishlistMemberId,
        private WishlistQueryRepositoryInterface $wishlistQueryRepository,
    ) {
    }

    /**
     * @return array<WishlistResponse>
     */
    public function execute(GetListWishlistRequest $request): array
    {
        $claimantWishlistMemberId = $this->getClaimantWishlistMemberId->getWishlistMemberId();

        return $this->wishlistQueryRepository->getList($request, $claimantWishlistMemberId);
    }
}
