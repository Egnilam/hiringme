<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist\WishlistGroup;

use App\Application\View\DeleteFormView;
use App\Application\View\LinkView;

readonly class WishlistGroupMemberView
{
    public function __construct(
        private string $pseudonym,
        private ?string $email,
        private bool $groupOwner,
        private bool $wishlist,
        private bool $owner,
        private ?LinkView $actionShowWishlist,
        private ?LinkView $actionCreateWishlist,
        private ?DeleteFormView $actionRemove,
    ) {

    }

    public function getPseudonym(): string
    {
        return $this->pseudonym;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function isGroupOwner(): bool
    {
        return $this->groupOwner;
    }

    public function isWishlist(): bool
    {
        return $this->wishlist;
    }

    public function isOwner(): bool
    {
        return $this->owner;
    }

    public function getActionShowWishlist(): ?LinkView
    {
        return $this->actionShowWishlist;
    }

    public function getActionCreateWishlist(): ?LinkView
    {
        return $this->actionCreateWishlist;
    }

    public function getActionRemove(): ?DeleteFormView
    {
        return $this->actionRemove;
    }
}
