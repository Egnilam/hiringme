<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberCommand;
use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class CreateWishlistGroupCommand implements CommandInterface
{
    private string $name;

    private string $ownerEmail;

    private string $ownerPseudonym;

    /**
     * @var array<CreateWishlistGroupMemberCommand>
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

    public function removeMember(int $index): void {
        unset($this->members[$index]);
    }
}
