<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final class WishlistMemberBasketItemResponse
{
    public function __construct(
        private readonly string $id,
        private readonly string $itemId,
        private readonly string $itemName,
        private readonly string $memberId,
        private readonly string $memberName,
        private readonly string $wishlistId,
        private readonly string $wishlistName,
        private readonly ?string $wishlistGroupId,
        private readonly ?string $wishlistGroupName,
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }

    public function getMemberId(): string
    {
        return $this->memberId;
    }

    public function getMemberName(): string
    {
        return $this->memberName;
    }

    public function getWishlistId(): string
    {
        return $this->wishlistId;
    }

    public function getWishlistName(): string
    {
        return $this->wishlistName;
    }

    public function getWishlistGroupId(): ?string
    {
        return $this->wishlistGroupId;
    }

    public function getWishlistGroupName(): ?string
    {
        return $this->wishlistGroupName;
    }
}
