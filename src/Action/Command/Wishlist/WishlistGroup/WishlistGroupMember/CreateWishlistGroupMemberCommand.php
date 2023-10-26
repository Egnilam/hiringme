<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class CreateWishlistGroupMemberCommand implements CommandInterface
{
    private string $pseudonym;

    private ?string $email;

    private bool $owner = false;

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function setPseudonym(string $pseudonym): self
    {
        $this->pseudonym = $pseudonym;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }

    public function setOwner(bool $owner): self
    {
        $this->owner = $owner;
        return $this;
    }
}
