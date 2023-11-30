<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final class WishlistResponse
{
    private bool $owner;
    /**
     * @param array<string> $groups
     * @param array<WishlistItemResponse> $items
     */
    public function __construct(
        private readonly string $id,
        private readonly string $wishlistMemberId,
        private readonly string $name,
        private readonly array  $groups,
        private readonly array  $items,
        private readonly string $visibility,
        string $claimantWishlistMemberId
    ) {
        $this->owner = $claimantWishlistMemberId === $this->wishlistMemberId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<string>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @return array<WishlistItemResponse>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }
}
