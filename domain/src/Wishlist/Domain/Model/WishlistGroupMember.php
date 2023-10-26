<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

final class WishlistGroupMember
{
    private string $id;

    private string $pseudonym;

    private string $wishlistMemberId;

    private string $wishlistGroupId;

    public function __construct(
        string $id,
        string $pseudonym,
        string $wishlistMemberId,
        string $wishlistGroupId
    ) {
        $this->id = $id;
        $this->pseudonym = $pseudonym;
        $this->wishlistMemberId = $wishlistMemberId;
        $this->wishlistGroupId = $wishlistGroupId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }
}
