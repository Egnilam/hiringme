<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist_group_member')]
#[ORM\HasLifecycleCallbacks]
class WishlistGroupMemberEntity implements EntityInterface
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistGroupEntity::class, inversedBy: 'wishlistGroupMembers')]
    #[ORM\JoinColumn(name: 'wishlist_group_id')]
    private WishlistGroupEntity $wishlistGroup;

    #[ORM\ManyToOne(targetEntity: WishlistMemberEntity::class)]
    #[ORM\JoinColumn(name: 'wishlist_member_id')]
    private WishlistMemberEntity $wishlistMember;

    #[ORM\Column(type: 'string', length: 255)]
    private string $pseudonym;

    #[ORM\Column(type: 'boolean')]
    private bool $owner = false;

    public function getWishlistGroup(): WishlistGroupEntity
    {
        return $this->wishlistGroup;
    }

    public function setWishlistGroup(WishlistGroupEntity $wishlistGroup): self
    {
        $this->wishlistGroup = $wishlistGroup;
        return $this;
    }

    public function getWishlistMember(): WishlistMemberEntity
    {
        return $this->wishlistMember;
    }

    public function setWishlistMember(WishlistMemberEntity $wishlistMember): self
    {
        $this->wishlistMember = $wishlistMember;
        return $this;
    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function setPseudonym(string $pseudonym): self
    {
        $this->pseudonym = $pseudonym;
        return $this;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }

    public function setOwner(bool $owner): self
    {
        $this->owner = $owner;
        return $this;
    }
}
