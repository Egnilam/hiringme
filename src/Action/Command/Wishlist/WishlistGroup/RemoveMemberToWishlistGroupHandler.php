<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\RemoveMemberToWishlistGroupInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\RemoveMemberToWishlistGroupRequest;

final readonly class RemoveMemberToWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(private RemoveMemberToWishlistGroupInterface $removeWishlistGroupMember)
    {

    }
    public function __invoke(RemoveMemberToWishlistGroupCommand $command): void
    {
        $this->removeWishlistGroupMember->execute(
            new RemoveMemberToWishlistGroupRequest(
                $command->getClaimantId(),
                $command->getWishlistGroupId(),
                $command->getWishlistGroupMemberId(),
            )
        );
    }
}
