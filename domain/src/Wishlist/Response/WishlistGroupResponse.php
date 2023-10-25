<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistGroupResponse
{
    public function __construct(
        private string $id,
        private string $name,
        private string $owner
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

    public function getOwner(): string
    {
        return $this->owner;
    }
}
