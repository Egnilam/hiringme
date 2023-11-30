<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistId;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;

final class Wishlist
{
    private WishlistId $id;

    private WishlistMemberId $memberId;

    private string $name;

    /**
     * @var array<WishlistGroupId>
     */
    private array $groups;

    /**
     * @var array<WishlistItem>
     */
    private array $items;

    private VisibilityEnum $visibility;

    /**
     * @param array<WishlistGroupId> $groups
     * @param array<WishlistItem> $items
     * @throws DomainException
     */
    public function __construct(
        WishlistId       $id,
        WishlistMemberId $wishlistMemberId,
        string           $name,
        array            $groups,
        array            $items,
        VisibilityEnum   $visibility
    ) {
        $this->id = $id;
        $this->memberId = $wishlistMemberId;
        $this->name = $name;
        $this->assignGroups($groups);
        $this->items = $items;
        $this->visibility = $visibility;
    }

    public function getId(): WishlistId
    {
        return $this->id;
    }

    public function getMemberId(): WishlistMemberId
    {
        return $this->memberId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array<WishlistGroupId>
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    /**
     * @return array<WishlistItem>
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getVisibility(): VisibilityEnum
    {
        return $this->visibility;
    }

    /**
     * @param array<WishlistGroupId> $groups
     * @throws DomainException
     */
    private function assignGroups(array $groups): void
    {
        $ids = [];
        foreach ($groups as $group) {
            if(isset($ids[$group->getId()])) {
                throw new DomainException('A wishlist cannot be attached to times at the same group');
            }

            $ids[$group->getId()] = $group->getId();
        }

        $this->groups = $groups;
    }
}
