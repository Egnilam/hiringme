<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist\WishlistItem;

use App\Application\View\DeleteFormView;
use App\Application\View\ExternalLinkView;
use App\Application\View\LinkView;

final readonly class WishlistItemView
{
    public function __construct(
        private string          $label,
        private ?float          $price,
        private ?string         $priority,
        private ?string         $description,
        private ?ExternalLinkView $actionGoToProduct,
        private ?DeleteFormView $actionRemove,
        private ?LinkView       $actionUpdate,
        private ?LinkView       $actionAddItemToBasket,
        private ?string         $actionRemoveItemToBasket,
        private bool            $owner,
    ) {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getActionGoToProduct(): ?ExternalLinkView
    {
        return $this->actionGoToProduct;
    }

    public function getActionRemove(): ?DeleteFormView
    {
        return $this->actionRemove;
    }

    public function getActionUpdate(): ?LinkView
    {
        return $this->actionUpdate;
    }

    public function getActionAddItemToBasket(): ?LinkView
    {
        return $this->actionAddItemToBasket;
    }

    public function getActionRemoveItemToBasket(): ?string
    {
        return $this->actionRemoveItemToBasket;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }
}
