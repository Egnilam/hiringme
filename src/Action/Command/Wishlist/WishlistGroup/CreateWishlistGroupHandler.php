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
        $memberCommands[] = $this->createWishlistGroupMemberOwner($command->getOwnerEmail(), $command->getOwnerPseudonym());

        foreach ($command->getMembers() as $memberCommand) {
            $memberCommands[] = new CreateWishlistGroupMemberRequest(
                'id',
                $memberCommand->getPseudonym(),
                $memberCommand->getEmail(),
                $memberCommand->isOwner(),
            );
        }

        $request = new CreateWishlistGroupRequest(
            $command->getName(),
            $memberCommands,
        );

        $this->createWishlistGroup->execute($request);
    }

    private function createWishlistGroupMemberOwner(string $email, string $pseudonym): CreateWishlistGroupMemberRequest {
        return new CreateWishlistGroupMemberRequest(
            'id',
            $pseudonym,
            $email,
            true
        );
    }
}
