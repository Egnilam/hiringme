<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

use Domain\Wishlist\Domain\Model\PriorityEnum;

final readonly class AddItemToWishlistRequest
{
    public function __construct(
        private string $wishlistId,
        private string $label,
        private ?string $link,
        private ?string $description,
        private ?PriorityEnum $priority,
        private ?float $price
    ) {
    }

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPriority(): ?PriorityEnum
    {
        return $this->priority;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
}
