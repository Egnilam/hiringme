<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

final class WishlistGroup
{
    private string $id;

    private string $owner;

    private string $name;

    /**
     * @var array<string>
     */
    private array $members;

    /**
     * @param array<string> $members
     */
    public function __construct(string $id, string $owner, string $name, array $members)
    {
        $this->id = $id;
        $this->owner = $owner;
        $this->name = $name;
        $this->members = $members;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getOwner(): string
    {
        return $this->owner;
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
