<?php

declare(strict_types=1);

namespace App\Application\Presenter\Wishlist\WishlistGroup;

use App\Application\Http\Wishlist\WishlistGroup\DeleteWishlistGroupController;
use App\Application\Http\Wishlist\WishlistGroup\ListWishlistGroupController;
use App\Application\Http\Wishlist\WishlistGroup\UpdateWishlistGroupController;
use App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember\AddMemberToWishlistGroupController;
use App\Application\Presenter\DeleteFormPresenter;
use App\Application\Presenter\LinkPresenter;
use App\Application\View\Wishlist\WishlistGroup\WishlistGroupView;
use Domain\Wishlist\Response\WishlistGroupMemberResponse;
use Domain\Wishlist\Response\WishlistGroupResponse;

readonly class WishlistGroupPresenter
{
    public function __construct(
        private LinkPresenter $linkPresenter,
        private DeleteFormPresenter $deleteFormPresenter,
        private WishlistGroupMemberPresenter $wishlistGroupMemberPresenter,
    ) {

    }

    public function present(WishlistGroupResponse $wishlistGroupResponse): WishlistGroupView
    {
        return new WishlistGroupView(
            $wishlistGroupResponse->getName(),
            $wishlistGroupResponse->getName(),
            array_map(fn (WishlistGroupMemberResponse $response) => $this->wishlistGroupMemberPresenter->present($response, $wishlistGroupResponse), $wishlistGroupResponse->getMembers()),
            $this->linkPresenter->present(
                'ui.wishlist.group.show_list',
                ListWishlistGroupController::NAME
            ),
            $this->linkPresenter->present(
                'ui.wishlist.group.update',
                UpdateWishlistGroupController::NAME,
                UpdateWishlistGroupController::getRequestParams($wishlistGroupResponse->getId())
            ),
            $this->deleteFormPresenter->present(
                $wishlistGroupResponse->getId(),
                DeleteWishlistGroupController::NAME,
                DeleteWishlistGroupController::getRequestParams($wishlistGroupResponse->getId())
            ),
            $this->linkPresenter->present(
                'ui.wishlist.group.member.add',
                AddMemberToWishlistGroupController::NAME,
                AddMemberToWishlistGroupController::getRequestParams($wishlistGroupResponse->getId())
            ),
        );
    }
}
