<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;

final class Wishlist
{
    private WishlistId $id;

    private WishlistMemberId $owner;

    private string $name;

    /**
     * @var array<WishlistItem>
     */
    private array $items;

    private VisibilityEnum $visibility;

    /**
     * @param array<WishlistItem> $items
     */
    public function __construct(WishlistId $id, WishlistMemberId $owner, string $name, array $items, VisibilityEnum $visibility)
    {
        $this->id = $id;
        $this->owner = $owner;
        $this->name = $name;
        $this->items = $items;
        $this->visibility = $visibility;
    }

    public function getId(): WishlistId
    {
        return $this->id;
    }

    public function getOwner(): WishlistMemberId
    {
        return $this->owner;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<WishlistItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getVisibility(): VisibilityEnum
    {
        return $this->visibility;
    }
}
