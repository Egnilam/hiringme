<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class CreateWishlistGroupMemberCommand implements CommandInterface
{
    private string $pseudonym;

    private ?string $email;

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
}
