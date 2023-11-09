<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;
use Domain\Wishlist\Domain\Model\PriorityEnum;

final class AddItemToWishlistCommand implements CommandInterface
{
    private string $wishlistId;

    private string $label;

    private ?string $link = null;

    private ?string $description = null;

    private ?PriorityEnum $priority = null;

    private ?float $price = null;

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function setWishlistId(string $wishlistId): self
    {
        $this->wishlistId = $wishlistId;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPriority(): ?PriorityEnum
    {
        return $this->priority;
    }

    public function setPriority(?PriorityEnum $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }
}
