<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\DeleteWishlistGroupInterface;
use Domain\Wishlist\Request\Command\DeleteWishlistRequest;

final class DeleteWishlistGroupHandler implements CommandHandlerInterface
{
    public function __construct(private DeleteWishlistGroupInterface $deleteWishlistGroup)
    {
    }

    public function __invoke(DeleteWishlistGroupCommand $command): void
    {
        $this->deleteWishlistGroup->execute(new DeleteWishlistRequest($command->getId()));
    }
}
