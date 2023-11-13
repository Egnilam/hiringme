<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\AssociateGroupMemberToWishlistInterface;
use Domain\Wishlist\Request\Command\AssociateGroupMemberToWishlistRequest;

final readonly class AssociateGroupMemberToWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private AssociateGroupMemberToWishlistInterface $associateGroupMemberToWishlist)
    {

    }

    public function __invoke(AssociateGroupMemberToWishlistCommand $command): void
    {
        $this->associateGroupMemberToWishlist->execute(new AssociateGroupMemberToWishlistRequest(
            $command->getWishlistId(),
            $command->getWishlistGroupId()
        ));
    }
}
