<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\AssociateGroupMemberToWishlistInterface;
use Domain\Wishlist\Port\Command\CreateWishlistInterface;
use Domain\Wishlist\Request\Command\AssociateGroupMemberToWishlistRequest;
use Domain\Wishlist\Request\Command\CreateWishlistRequest;

final readonly class CreateWishlistHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateWishlistInterface $createWishlist,
        private AssociateGroupMemberToWishlistInterface $associateGroupMemberToWishlist
    ) {
    }

    public function __invoke(CreateWishlistCommand $command): void
    {
        $wishlistId = $this->createWishlist->execute(new CreateWishlistRequest(
            $command->getWishlistMemberId(),
            $command->getName(),
            $command->getVisibility()
        ));

        if($command->getWishlistGroupId()) {
            $this->associateGroupMemberToWishlist->execute(
                new AssociateGroupMemberToWishlistRequest($wishlistId->getId(), $command->getWishlistGroupId())
            );
        }
    }
}
