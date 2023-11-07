<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup;

final readonly class CreateWishlistGroupRequest
{
    /**
     * @param array<AddMemberToWishlistGroupRequest> $members
     */
    public function __construct(
        private string $name,
        private array $members,
    ) {

    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<AddMemberToWishlistGroupRequest>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
