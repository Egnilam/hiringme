<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\AddMemberToWishlistGroupRequest;
use Domain\Wishlist\Request\Command\WishlistGroup\CreateWishlistGroupRequest;

final readonly class CreateWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateWishlistGroupInterface $createWishlistGroup,
    ) {

    }

    public function __invoke(CreateWishlistGroupCommand $command): void
    {
        $memberRequests[] = $this->createWishlistGroupMemberOwner($command->getOwnerEmail(), $command->getOwnerPseudonym());

        foreach ($command->getMembers() as $memberCommand) {
            $memberRequests[] = new AddMemberToWishlistGroupRequest(
                'id',
                $memberCommand->getPseudonym(),
                $memberCommand->getEmail(),
                $memberCommand->isOwner(),
            );
        }

        $request = new CreateWishlistGroupRequest(
            $command->getName(),
            $memberRequests,
        );

        $this->createWishlistGroup->execute($request);
    }

    private function createWishlistGroupMemberOwner(string $email, string $pseudonym): AddMemberToWishlistGroupRequest
    {
        return new AddMemberToWishlistGroupRequest(
            'id',
            $pseudonym,
            $email,
            true
        );
    }
}
