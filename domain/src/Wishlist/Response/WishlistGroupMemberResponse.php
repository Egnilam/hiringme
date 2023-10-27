<?php

declare(strict_types=1);

namespace Domain\Wishlist\Response;

final readonly class WishlistGroupMemberResponse
{
    public function __construct(
        private string $id,
        private string $pseudonym,
        private ?string $email,
        private bool $owner
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }
}
