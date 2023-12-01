<?php

declare(strict_types=1);

namespace App\Application\View\Wishlist\WishlistGroup;

use App\Application\View\DeleteFormView;
use App\Application\View\LinkView;
use Domain\Wishlist\Response\WishlistGroupMemberResponse;

readonly class WishlistGroupView
{
    /**
     * @param array<WishlistGroupMemberView> $wishlistGroupMembers
     */
    public function __construct(
        private string $pageTitle,
        private string $title,
        private array $wishlistGroupMembers,
        private LinkView $actionBackToPreviousPage,
        private LinkView $actionUpdate,
        private DeleteFormView $actionDelete,
        private LinkView $actionAddGroupMember,
    ) {
    }

    public function getPageTitle(): string
    {
        return $this->pageTitle;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return array<WishlistGroupMemberView>
     */
    public function getWishlistGroupMembers(): array
    {
        return $this->wishlistGroupMembers;
    }

    public function getActionBackToPreviousPage(): LinkView
    {
        return $this->actionBackToPreviousPage;
    }

    public function getActionUpdate(): LinkView
    {
        return $this->actionUpdate;
    }

    public function getActionDelete(): DeleteFormView
    {
        return $this->actionDelete;
    }

    public function getActionAddGroupMember(): LinkView
    {
        return $this->actionAddGroupMember;
    }
}
