<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist')]
#[ORM\HasLifecycleCallbacks]
class WishlistEntity implements EntityInterface
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistMemberEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'owner_id', nullable: false)]
    private WishlistMemberEntity $wishlistMember;

    #[ORM\Column(type:'string', length: 255)]
    private string $name;

    #[ORM\Column(type:'string', length: 255)]
    private string $visibility;

    public function getWishlistMember(): WishlistMemberEntity
    {
        return $this->wishlistMember;
    }

    public function setWishlistMember(WishlistMemberEntity $wishlistMember): self
    {
        $this->wishlistMember = $wishlistMember;
        return $this;
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

    public function getVisibility(): string
    {
        return $this->visibility;
    }

    public function setVisibility(string $visibility): self
    {
        $this->visibility = $visibility;
        return $this;
    }
}
