<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

use Domain\Wishlist\Domain\Model\VisibilityEnum;

abstract readonly class AbstractWishlistRequest
{
    public function __construct(
        private string         $wishlistMemberId,
        private string         $name,
        private VisibilityEnum $visibility,
    ) {

    }

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getVisibility(): VisibilityEnum
    {
        return $this->visibility;
    }
}
