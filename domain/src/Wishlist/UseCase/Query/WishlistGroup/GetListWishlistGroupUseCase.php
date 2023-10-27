<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Query\WishlistGroup;

use Domain\Wishlist\Port\Query\WishlistGroup\GetListWishlistGroupInterface;
use Domain\Wishlist\Repository\Query\WishlistGroupQueryRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\GetListWishlistGroupRequest;

final readonly class GetListWishlistGroupUseCase implements GetListWishlistGroupInterface
{
    public function __construct(private WishlistGroupQueryRepositoryInterface $wishlistGroupQueryRepository)
    {
    }

    /**
     * @inheritDoc
     */
    public function execute(GetListWishlistGroupRequest $request): array
    {
        return $this->wishlistGroupQueryRepository->getList($request);
    }
}
