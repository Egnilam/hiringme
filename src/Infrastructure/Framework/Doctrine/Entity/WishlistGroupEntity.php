<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist_group')]
#[ORM\HasLifecycleCallbacks]
class WishlistGroupEntity implements EntityInterface
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\Column(type:'string', length: 255)]
    private string $name;

    /**
     * @var Collection<int, WishlistItemEntity>
     */
    #[ORM\OneToMany(mappedBy: 'wishlistGroup', targetEntity: WishlistGroupMemberEntity::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $wishlistGroupMembers;

    public function __construct()
    {
        $this->wishlistGroupMembers = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<int, WishlistItemEntity>
     */
    public function getWishlistGroupMembers(): Collection
    {
        return $this->wishlistGroupMembers;
    }
}
