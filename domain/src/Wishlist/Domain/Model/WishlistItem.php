<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\ValueObject\LinkItem;
use Domain\Wishlist\Domain\ValueObject\PriceItem;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Response\WishlistItemResponse;

final class WishlistItem
{
    private string $id;

    private WishlistId $wishlistId;

    private string $label;

    private ?LinkItem $link;

    private ?string $description;

    private ?PriorityEnum $priority;

    private ?PriceItem $price;

    public function __construct(
        string $id,
        WishlistId $wishlistId,
        string $label,
        ?LinkItem $link,
        ?string $description,
        ?PriorityEnum $priority,
        ?PriceItem $price
    ) {
        $this->id = $id;
        $this->wishlistId = $wishlistId;
        $this->label = $label;
        $this->link = $link;
        $this->description = $description;
        $this->priority = $priority;
        $this->price = $price;
    }

    /**
     * @throws DomainException
     */
    public static function createFromResponse(WishlistItemResponse $item, WishlistId $wishlistId): self
    {
        return new WishlistItem(
            $item->getId(),
            $wishlistId,
            $item->getLabel(),
            $item->getLink() ? new LinkItem($item->getLink()) : null,
            $item->getDescription(),
            $item->getPriority() ? PriorityEnum::from($item->getPriority()) : null,
            $item->getPrice() ? new PriceItem($item->getPrice()) : null,
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWishlistId(): WishlistId
    {
        return $this->wishlistId;
    }

    public function getLabel(): string
    {
        return $this->label;
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

    public function getPrice(): ?PriceItem
    {
        return $this->price;
    }
}
