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

    #[ORM\Column('string', length: 255)]
    private string $name;

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
