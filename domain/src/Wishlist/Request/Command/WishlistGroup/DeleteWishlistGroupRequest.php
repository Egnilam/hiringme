<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup;

final readonly class DeleteWishlistGroupRequest
{
    public function __construct(
        private string $id
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
