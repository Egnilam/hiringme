<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist_member')]
#[ORM\HasLifecycleCallbacks]
class WishlistMemberEntity
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: UserEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'user_id', nullable: true)]
    private ?UserEntity $user = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'boolean')]
    private bool $registered = false;

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(?UserEntity $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function isRegistered(): bool
    {
        return $this->registered;
    }

    public function setRegistered(bool $registered): self
    {
        $this->registered = $registered;
        return $this;
    }
}
