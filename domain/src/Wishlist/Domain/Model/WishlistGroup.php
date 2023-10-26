<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Wishlist\Domain\ValueObject\WishlistGroupMembersValueObject;

final class WishlistGroup
{
    private string $id;

    private string $name;

    /**
     * @var array<string>
     */
    private array $members;

    public function __construct(string $id, string $name, WishlistGroupMembersValueObject $wishlistGroupMembersValueObject)
    {
        $this->id = $id;
        $this->name = $name;
        $this->members = $wishlistGroupMembersValueObject->getMembers();
    }

    public function getId(): string
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
