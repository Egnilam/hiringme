<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\ValueObject\Email;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;

final class WishlistGroupMember
{
    private string $id;

    private string $pseudonym;

    private ?Email $email;

    private WishlistMemberId $wishlistMemberId;

    private WishlistGroupId $wishlistGroupId;

    private bool $owner;

    public function __construct(
        string           $id,
        string           $pseudonym,
        ?Email           $email,
        WishlistMemberId $wishlistMemberId,
        WishlistGroupId  $wishlistGroupId,
        bool             $owner
    ) {
        $this->id = $id;
        $this->pseudonym = $pseudonym;
        $this->email = $email;
        $this->wishlistMemberId = $wishlistMemberId;
        $this->wishlistGroupId = $wishlistGroupId;
        $this->owner = $owner;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }

    public function getWishlistMemberId(): WishlistMemberId
    {
        return $this->wishlistMemberId;
    }

    public function getWishlistGroupId(): WishlistGroupId
    {
        return $this->wishlistGroupId;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }
}
