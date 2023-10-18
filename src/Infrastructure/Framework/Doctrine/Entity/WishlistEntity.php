<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist')]
#[ORM\HasLifecycleCallbacks]
class WishlistEntity
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistMemberEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'owner_id')]
    private WishlistMemberEntity $user;

    #[ORM\Column('string', length: 255)]
    private string $name;

    public function getUser(): WishlistMemberEntity
    {
        return $this->user;
    }

    public function setUser(WishlistMemberEntity $user): self
    {
        $this->user = $user;
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
