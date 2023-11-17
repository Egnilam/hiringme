<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Command;

use Domain\Wishlist\Domain\Model\PriorityEnum;

final readonly class UpdateItemOfWishlistRequest extends AbstractWishlistItemRequest
{
    public function __construct(
        private string $id,
        private string $wishlistId,
        private string $label,
        private ?string $link,
        private ?string $description,
        private ?PriorityEnum $priority,
        private ?float $price
    ) {
        parent::__construct(
            $this->wishlistId,
            $this->label,
            $this->link,
            $this->description,
            $this->priority,
            $this->price
        );
    }

    public function getId(): string
    {
        return $this->id;
    }
}
