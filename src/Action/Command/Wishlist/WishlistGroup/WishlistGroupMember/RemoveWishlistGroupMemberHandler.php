<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\RemoveWishlistGroupMemberInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\RemoveWishlistGroupMemberRequest;

final readonly class RemoveWishlistGroupMemberHandler implements CommandHandlerInterface
{
    public function __construct(private RemoveWishlistGroupMemberInterface $removeWishlistGroupMember)
    {

    }
    public function __invoke(RemoveWishlistGroupMemberCommand $command): void
    {
        $this->removeWishlistGroupMember->execute(
            new RemoveWishlistGroupMemberRequest(
                $command->getClaimantId(),
                $command->getWishlistGroupId(),
                $command->getWishlistGroupMemberId(),
            )
        );
    }
}
