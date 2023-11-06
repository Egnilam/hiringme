<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberRequest;

final readonly class AddWishlistGroupMemberHandler implements CommandHandlerInterface
{
    public function __construct(private AddWishlistGroupMemberInterface $addWishlistGroupMember)
    {
    }

    public function __invoke(AddWishlistGroupMemberCommand $command): void
    {
        $addWishlistGroupMemberRequest = new AddWishlistGroupMemberRequest(
            $command->getWishlistGroupId() ?? 'id',
            $command->getPseudonym(),
            $command->getEmail(),
            $command->isOwner()
        );

        $this->addWishlistGroupMember->execute($addWishlistGroupMemberRequest);
    }
}
