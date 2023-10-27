<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistGroupResponse
{
    /**
     * @param array<WishlistGroupMemberResponse> $members
     */
    public function __construct(
        private string $id,
        private string $name,
        private array $members = []
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

    /**
     * @return array<WishlistGroupMemberResponse>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
