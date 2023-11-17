<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\UpdateWishlistGroupInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\UpdateWishlistGroupRequest;

final readonly class UpdateWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(private UpdateWishlistGroupInterface $updateWishlistGroup)
    {
    }

    public function __invoke(UpdateWishlistGroupCommand $command): void
    {
        $this->updateWishlistGroup->execute(new UpdateWishlistGroupRequest(
            $command->getId(),
            $command->getName()
        ));
    }
}
