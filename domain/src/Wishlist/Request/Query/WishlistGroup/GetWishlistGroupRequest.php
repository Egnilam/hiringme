<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistGroup;

final readonly class GetWishlistGroupRequest
{
    public function __construct(
        private string $id,
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }
}
