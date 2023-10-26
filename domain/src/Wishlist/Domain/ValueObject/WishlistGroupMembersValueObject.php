<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\ValueObject;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

class WishlistGroupMembersValueObject
{
    public const MIN_OWNER = 1;
    public const MAX_OWNER = 1;
    public const MIN_MEMBER = 1;

    /**
     * @var array<string>
     */
    private array $members;

    /**
     * @param array<CreateWishlistGroupMemberRequest> $members
     * @throws DomainException
     */
    public function __construct(array $members)
    {
        if(count($members) < self::MIN_MEMBER) {
            throw new DomainException(sprintf('Should have at least %d members', self::MIN_MEMBER));
        }

        $owner = 0;
        foreach ($members as $member) {
            $owner += $member->isOwner() ? 1 : 0;

            if(isset($this->members[$member->getPseudonym()])) {
                throw new DomainException('Cant have two times the same pseudonym');
            }

            $this->members[] = $member->getPseudonym();
        }

        if($owner < self::MIN_OWNER) {
            throw new DomainException(sprintf('Should have at least %d owner', self::MIN_OWNER));
        }

        if($owner > self::MAX_OWNER) {
            throw new DomainException(sprintf('To many owners, max %d', self::MAX_OWNER));
        }

    }

    /**
     * @return array<string>
     */
    public function getMembers(): array
    {
        return $this->members;
    }
}
