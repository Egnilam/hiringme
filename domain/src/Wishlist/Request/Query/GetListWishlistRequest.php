<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query;

final readonly class GetListWishlistRequest
{
    public function __construct(
        private ?string $wishlistMemberId = null,
    ) {

    }

    public function getWishlistMemberId(): ?string
    {
        return $this->wishlistMemberId;
    }
}
