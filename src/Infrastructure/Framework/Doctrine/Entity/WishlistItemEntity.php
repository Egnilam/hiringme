<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'wishlist_item')]
#[ORM\HasLifecycleCallbacks]
class WishlistItemEntity implements EntityInterface
{
    use EntityIdTrait;

    use EntityDecoratorTrait;

    #[ORM\ManyToOne(targetEntity: WishlistEntity::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'wishlist_id', nullable: false)]
    private WishlistEntity $wishlist;

    #[ORM\Column(type:'string', length: 255)]
    private string $label;

    #[ORM\Column(type:'text', nullable: true)]
    private ?string $link = null;

    #[ORM\Column(type:'string', length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type:'string', length: 255, nullable: true)]
    private ?string $priority = null;

    #[ORM\Column(type:'float', precision: 2, nullable: true)]
    private ?float $price = null;

    public function getWishlist(): WishlistEntity
    {
        return $this->wishlist;
    }

    public function setWishlist(WishlistEntity $wishlist): self
    {
        $this->wishlist = $wishlist;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(?string $priority): self
    {
        $this->priority = $priority;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;
        return $this;
    }
}
