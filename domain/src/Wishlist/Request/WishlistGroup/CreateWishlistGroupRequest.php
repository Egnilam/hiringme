<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\WishlistGroup;

final class CreateWishlistGroupRequest
{
    /**
     * @param array<string> $members
     */
    public function __construct(
        private string $owner,
        private string $name,
        private array $members,
    ) {

    }

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<string>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
