<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\ValueObject;

final readonly class WishlistGroupId
{
    public function __construct(private string $id)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }
}
