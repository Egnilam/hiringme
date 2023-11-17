<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistItemResponse
{
    public function __construct(
        private string $id,
        private string $label,
        private ?string $link,
        private ?string $description,
        private ?string $priority,
        private ?float $price
    ) {
    }

    public function getId(): string
    {
        return $this->id;
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

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
}
