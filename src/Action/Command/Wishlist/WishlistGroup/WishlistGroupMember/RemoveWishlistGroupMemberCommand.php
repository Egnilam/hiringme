<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class RemoveWishlistGroupMemberCommand implements CommandInterface
{
    private string $claimantId;

    private string $wishlistGroupId;

    private string $wishlistGroupMemberId;

    public function getClaimantId(): string
    {
        return $this->claimantId;
    }

    public function setClaimantId(string $claimantId): self
    {
        $this->claimantId = $claimantId;
        return $this;
    }

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }

    public function setWishlistGroupId(string $wishlistGroupId): self
    {
        $this->wishlistGroupId = $wishlistGroupId;
        return $this;
    }

    public function getWishlistGroupMemberId(): string
    {
        return $this->wishlistGroupMemberId;
    }

    public function setWishlistGroupMemberId(string $wishlistGroupMemberId): self
    {
        $this->wishlistGroupMemberId = $wishlistGroupMemberId;
        return $this;
    }
}
