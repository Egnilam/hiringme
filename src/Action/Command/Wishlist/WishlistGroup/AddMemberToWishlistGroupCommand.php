<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class AddMemberToWishlistGroupCommand implements CommandInterface
{
    private string $wishlistGroupId;

    #[Assert\NotBlank]
    private string $pseudonym;

    private ?string $email = null;

    private bool $owner = false;

    public function getWishlistGroupId(): string
    {
        return $this->wishlistGroupId;
    }

    public function setWishlistGroupId(string $wishlistGroupId): self
    {
        $this->wishlistGroupId = $wishlistGroupId;
        return $this;
    }

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
