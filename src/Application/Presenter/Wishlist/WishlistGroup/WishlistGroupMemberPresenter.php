<?php

declare(strict_types=1);

namespace App\Application\Presenter\Wishlist\WishlistGroup;

use App\Application\Http\Wishlist\ShowWishlistController;
use App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember\AssociateWishlistToGroupMemberController;
use App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember\RemoveMemberToWishlistGroupController;
use App\Application\Presenter\DeleteFormPresenter;
use App\Application\Presenter\LinkPresenter;
use App\Application\View\Wishlist\WishlistGroup\WishlistGroupMemberView;
use Domain\Wishlist\Response\WishlistGroupMemberResponse;
use Domain\Wishlist\Response\WishlistGroupResponse;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;

readonly class WishlistGroupMemberPresenter
{
    public function __construct(
        private LinkPresenter $linkPresenter,
        private DeleteFormPresenter $deleteFormPresenter,
        private GetClaimantWishlistMemberIdInterface $getClaimantWishlistMemberId
    ) {

    }

    public function present(
        WishlistGroupMemberResponse $wishlistGroupMemberResponse,
        WishlistGroupResponse $wishlistGroupResponse
    ): WishlistGroupMemberView {

        return new WishlistGroupMemberView(
            $wishlistGroupMemberResponse->getPseudonym(),
            $wishlistGroupMemberResponse->getEmail(),
            $wishlistGroupMemberResponse->isOwner(),
            (bool)$wishlistGroupMemberResponse->getWishlistId(),
            $this->getClaimantWishlistMemberId->get() === $wishlistGroupMemberResponse->getWishlistMemberId(),
            $wishlistGroupMemberResponse->getWishlistId() ? $this->linkPresenter->present(
                'ui.wishlist.group.member.show_wishlist',
                ShowWishlistController::NAME,
                ShowWishlistController::getRequestParams($wishlistGroupMemberResponse->getWishlistId(), $wishlistGroupResponse->getId())
            ) : null,
            $this->linkPresenter->present(
                'ui.wishlist.group.member.associate_wishlist',
                AssociateWishlistToGroupMemberController::NAME,
                AssociateWishlistToGroupMemberController::getRequestParams($wishlistGroupResponse->getId(), $wishlistGroupMemberResponse->getWishlistMemberId())
            ),
            $this->deleteFormPresenter->present(
                $wishlistGroupMemberResponse->getId(),
                RemoveMemberToWishlistGroupController::NAME,
                RemoveMemberToWishlistGroupController::getRequestParams($wishlistGroupResponse->getId(), $wishlistGroupMemberResponse->getId())
            )
        );
    }
}
