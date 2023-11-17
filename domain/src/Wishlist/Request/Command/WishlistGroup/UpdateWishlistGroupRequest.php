<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup;

final readonly class UpdateWishlistGroupRequest
{
    public function __construct(
        private string $id,
        private string $name,
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
