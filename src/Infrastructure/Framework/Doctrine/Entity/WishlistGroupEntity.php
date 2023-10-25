<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist_group')]
#[ORM\HasLifecycleCallbacks]
class WishlistGroupEntity implements EntityInterface
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistMemberEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'owner_id')]
    private WishlistMemberEntity $owner;

    #[ORM\Column('string', length: 255)]
    private string $name;

    public function getOwner(): WishlistMemberEntity
    {
        return $this->owner;
    }

    public function setOwner(WishlistMemberEntity $owner): self
    {
        $this->owner = $owner;
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
}
