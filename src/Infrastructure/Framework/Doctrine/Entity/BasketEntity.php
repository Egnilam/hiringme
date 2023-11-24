<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'basket')]
#[ORM\HasLifecycleCallbacks]
class BasketEntity implements EntityInterface
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistMemberEntity::class)]
    #[ORM\JoinColumn(name: 'wishlist_member_id', nullable: false)]
    private WishlistMemberEntity $wishlistMember;

    #[ORM\ManyToOne(targetEntity: WishlistItemEntity::class)]
    #[ORM\JoinColumn(name: 'wishlist_item_id', nullable: false)]
    private WishlistItemEntity $wishlistItem;

    #[ORM\Column(type: 'boolean')]
    private bool $visibleName;

    #[ORM\Column(type: 'boolean')]
    private bool $canBeShared;

    public function getWishlistMember(): WishlistMemberEntity
    {
        return $this->wishlistMember;
    }

    public function setWishlistMember(WishlistMemberEntity $wishlistMember): self
    {
        $this->wishlistMember = $wishlistMember;
        return $this;
    }

    public function getWishlistItem(): WishlistItemEntity
    {
        return $this->wishlistItem;
    }

    public function setWishlistItem(WishlistItemEntity $wishlistItem): self
    {
        $this->wishlistItem = $wishlistItem;
        return $this;
    }

    public function isVisibleName(): bool
    {
        return $this->visibleName;
    }

    public function setVisibleName(bool $visibleName): self
    {
        $this->visibleName = $visibleName;
        return $this;
    }

    public function isCanBeShared(): bool
    {
        return $this->canBeShared;
    }

    public function setCanBeShared(bool $canBeShared): self
    {
        $this->canBeShared = $canBeShared;
        return $this;
    }
}
