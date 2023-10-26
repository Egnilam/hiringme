<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Request\WishlistGroup\CreateWishlistGroupRequest;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;

final readonly class CreateWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateWishlistGroupInterface $createWishlistGroup,
    ) {

    }

    public function __invoke(CreateWishlistGroupCommand $command): void
    {
        $memberCommands = [];
        foreach ($command->getMembers() as $memberCommand) {
            $memberCommands[] = new CreateWishlistGroupMemberRequest(
                'id',
                $memberCommand->getPseudonym(),
                $memberCommand->getEmail()
            );
        }

        $request = new CreateWishlistGroupRequest(
            $command->getOwner(),
            $command->getName(),
            $memberCommands,
        );

        $this->createWishlistGroup->execute($request);
    }
}
