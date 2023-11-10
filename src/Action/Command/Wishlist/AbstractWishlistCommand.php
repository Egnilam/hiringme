<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use Domain\Wishlist\Domain\Model\VisibilityEnum;

abstract class AbstractWishlistCommand
{
    private string $wishlistMemberId;

    private string $name;

    private VisibilityEnum $visibility;

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function setWishlistMemberId(string $wishlistMemberId): self
    {
        $this->wishlistMemberId = $wishlistMemberId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getVisibility(): VisibilityEnum
    {
        return $this->visibility;
    }

    public function setVisibility(VisibilityEnum $visibility): self
    {
        $this->visibility = $visibility;
        return $this;
    }
}
