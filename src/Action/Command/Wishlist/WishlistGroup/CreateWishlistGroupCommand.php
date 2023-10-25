<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class CreateWishlistGroupCommand implements CommandInterface
{
    private string $owner;

    private string $name;

    /**
     * @var array<string>
     */
    private array $members;

    public function getOwner(): string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;
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

    /**
     * @return array<string>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array<string> $members
     */
    public function setMembers(array $members): self
    {
        $this->members = $members;
        return $this;
    }
}
