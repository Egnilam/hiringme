<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist_group_member')]
#[ORM\HasLifecycleCallbacks]
class WishlistGroupMemberEntity
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistGroupEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'wishlist_group_id')]
    private WishlistGroupEntity $wishlistGroup;

    #[ORM\ManyToOne(targetEntity: WishlistMemberEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'wishlist_member_id')]
    private WishlistMemberEntity $wishlistMember;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $pseudonym = null;

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

    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }

    public function setPseudonym(?string $pseudonym): self
    {
        $this->pseudonym = $pseudonym;
        return $this;
    }
}
