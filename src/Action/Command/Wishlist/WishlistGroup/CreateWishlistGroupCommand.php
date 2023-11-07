<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class CreateWishlistGroupCommand implements CommandInterface
{
    private string $name;

    private string $ownerEmail;

    private string $ownerPseudonym;

    /**
     * @var array<AddMemberToWishlistGroupCommand>
     */
    private array $members;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getOwnerEmail(): string
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail(string $ownerEmail): self
    {
        $this->ownerEmail = $ownerEmail;
        return $this;
    }

    public function getOwnerPseudonym(): string
    {
        return $this->ownerPseudonym;
    }

    public function setOwnerPseudonym(string $ownerPseudonym): self
    {
        $this->ownerPseudonym = $ownerPseudonym;
        return $this;
    }

    /**
     * @return array<AddMemberToWishlistGroupCommand>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array<AddMemberToWishlistGroupCommand> $members
     */
    public function setMembers(array $members): self
    {
        $this->members = $members;
        return $this;
    }

    public function removeMember(int $index): void
    {
        unset($this->members[$index]);
    }
}
