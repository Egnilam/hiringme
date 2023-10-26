<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query\WishlistMember;

use Domain\Wishlist\Port\Query\WishlistMember\GetWishlistMemberInterface;
use Domain\Wishlist\Repository\Query\WishlistMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;

final readonly class GetWishlistMemberUseCase implements GetWishlistMemberInterface
{
    public function __construct(private WishlistMemberQueryRepositoryInterface $wishlistMemberQueryRepository)
    {
    }

    public function execute(GetWishlistMemberRequest $request): WishlistMemberResponse
    {
        return $this->wishlistMemberQueryRepository->get($request);
    }
}
