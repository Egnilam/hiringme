<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query;

final readonly class GetWishlistRequest
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
