<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupMembers;

final class WishlistGroup
{
    private WishlistGroupId $id;

    private string $name;

    /**
     * @var array<string>
     */
    private array $members;

    public function __construct(WishlistGroupId $id, string $name, WishlistGroupMembers $wishlistGroupMembersValueObject)
    {
        $this->id = $id;
        $this->name = $name;
        $this->members = $wishlistGroupMembersValueObject->getMembers();
    }

    public function getId(): WishlistGroupId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<string>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
