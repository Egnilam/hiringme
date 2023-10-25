<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Request\WishlistGroup\CreateWishlistGroupRequest;

final readonly class CreateWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateWishlistGroupInterface $createWishlistGroup,
    ) {

    }

    public function __invoke(CreateWishlistGroupCommand $createWishlistGroupCommand): void
    {
        $createWishListGroupRequest = new CreateWishlistGroupRequest(
            $createWishlistGroupCommand->getOwner(),
            $createWishlistGroupCommand->getName(),
            $createWishlistGroupCommand->getMembers(),
        );

        $this->createWishlistGroup->execute($createWishListGroupRequest);
    }
}
