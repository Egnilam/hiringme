<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberCommand;
use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class CreateWishlistGroupCommand implements CommandInterface
{
    private string $owner;

    private string $name;

    /**
     * @var array<CreateWishlistGroupMemberCommand>
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
     * @return array<CreateWishlistGroupMemberCommand>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array<CreateWishlistGroupMemberCommand> $members
     */
    public function setMembers(array $members): self
    {
        $this->members = $members;
        return $this;
    }
}
