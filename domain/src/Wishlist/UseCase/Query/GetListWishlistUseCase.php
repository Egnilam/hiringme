<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query;

use Domain\Wishlist\Port\Query\GetListWishlistInterface;
use Domain\Wishlist\Repository\Query\WishlistQueryRepositoryInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;

final readonly class GetListWishlistUseCase implements GetListWishlistInterface
{
    public function __construct(private WishlistQueryRepositoryInterface $wishlistQueryRepository)
    {
    }

    /**
     * @return array<WishlistResponse>
     */
    public function execute(GetListWishlistRequest $request): array
    {
        return $this->wishlistQueryRepository->getList($request);
    }
}
