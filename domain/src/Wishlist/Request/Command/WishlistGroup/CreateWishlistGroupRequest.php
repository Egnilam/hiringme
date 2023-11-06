<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command\WishlistGroup;

use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberRequest;

final readonly class CreateWishlistGroupRequest
{
    /**
     * @param array<AddWishlistGroupMemberRequest> $members
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
     * @return array<AddWishlistGroupMemberRequest>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
