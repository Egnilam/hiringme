<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;

final class WishlistGroup
{
    private const MIN_OWNER = 1;
    private const MAX_OWNER = 1;
    private const MIN_MEMBER = 1;

    private WishlistGroupId $id;

    private string $name;

    /**
     * @var array<WishlistGroupMember>
     */
    private array $members;

    /**
     * @param array<WishlistGroupMember> $members
     * @throws DomainException
     */
    public function __construct(WishlistGroupId $id, string $name, array $members)
    {
        $this->id = $id;
        $this->name = $name;
        $this->assignMembers($members);
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
     * @return array<WishlistGroupMember>
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    /**
     * @param array<WishlistGroupMember> $members
     * @throws DomainException
     */
    private function assignMembers(array $members): void
    {
        if(count($members) < self::MIN_MEMBER) {
            throw new DomainException(sprintf('Should have at least %d members', self::MIN_MEMBER));
        }

        $ownerCount = 0;
        $pseudonyms = [];
        $emails = [];
        foreach ($members as $member) {
            $ownerCount += $member->isOwner() ? 1 : 0;

            if(isset($pseudonyms[$member->getPseudonym()])) {
                throw new DomainException('Each pseudonym should be individual');
            }

            $pseudonyms[$member->getPseudonym()] = $member->getPseudonym();

            if(isset($emails[$member->getEmail()?->get()])) {
                throw new DomainException('Each email should be individual');
            }

            if($member->getEmail()) {
                $emails[$member->getEmail()->get()] = $member->getEmail()->get();
            }
        }

        if($ownerCount < self::MIN_OWNER) {
            throw new DomainException(sprintf('Should have at least %d owner', self::MIN_OWNER));
        }

        if($ownerCount > self::MAX_OWNER) {
            throw new DomainException(sprintf('To many owners, max %d', self::MAX_OWNER));
        }

        $this->members = $members;
    }
}
