<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistResponse
{
    /**
     * @param array<string> $groups
     * @param array<WishlistItemResponse> $items
     */
    public function __construct(
        private string $id,
        private string $owner,
        private string $name,
        private array $groups,
        private array $items,
        private string $visibility
    ) {

    }

    public function getId(): string
    {
        return $this->id;
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
}
