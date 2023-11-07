<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\AddMemberToWishlistGroupInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\AddMemberToWishlistGroupRequest;

final readonly class AddMemberToWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(private AddMemberToWishlistGroupInterface $addWishlistGroupMember)
    {
    }

    public function __invoke(AddMemberToWishlistGroupCommand $command): void
    {
        $addWishlistGroupMemberRequest = new AddMemberToWishlistGroupRequest(
            $command->getWishlistGroupId() ?? 'id',
            $command->getPseudonym(),
            $command->getEmail(),
            $command->isOwner()
        );

        $this->addWishlistGroupMember->execute($addWishlistGroupMemberRequest);
    }
}
