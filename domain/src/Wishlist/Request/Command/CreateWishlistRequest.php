<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

use Domain\Wishlist\Domain\Model\VisibilityEnum;

final readonly class CreateWishlistRequest
{
    public function __construct(
        private string $owner,
        private string $name,
        private VisibilityEnum $visibility,
    ) {

    }

    public function getOwner(): string
    {
        return $this->owner;
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
