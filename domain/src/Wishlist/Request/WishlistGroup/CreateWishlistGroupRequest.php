<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\WishlistGroup;

use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

final readonly class CreateWishlistGroupRequest
{
    /**
     * @param array<CreateWishlistGroupMemberRequest> $members
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
     * @return array<CreateWishlistGroupMemberRequest>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
