<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Wishlist\Domain\ValueObject\ImageItem;
use Domain\Wishlist\Domain\ValueObject\LinkItem;
use Domain\Wishlist\Domain\ValueObject\PriceItem;

final class WishlistItem
{
    private string $id;

    private string $name;

    private ?string $description;

    private ?PriorityEnum $priority;

    private ?LinkItem $link;

    private ?ImageItem $img;

    private ?PriceItem $price;

    public function __construct(string $id, string $name, ?string $description, ?PriorityEnum $priority, ?LinkItem $link, ?ImageItem $img, ?PriceItem $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->priority = $priority;
        $this->link = $link;
        $this->img = $img;
        $this->price = $price;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPriority(): ?PriorityEnum
    {
        return $this->priority;
    }

    public function getLink(): ?LinkItem
    {
        return $this->link;
    }

    public function getImg(): ?ImageItem
    {
        return $this->img;
    }

    public function getPrice(): ?PriceItem
    {
        return $this->price;
    }
}
