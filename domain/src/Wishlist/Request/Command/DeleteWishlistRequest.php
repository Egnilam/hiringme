<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

final readonly class DeleteWishlistRequest
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
