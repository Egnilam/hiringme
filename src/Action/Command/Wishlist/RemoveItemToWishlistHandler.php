<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\RemoveItemToWishlistInterface;
use Domain\Wishlist\Request\Command\RemoveItemToWishlistRequest;

final readonly class RemoveItemToWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private RemoveItemToWishlistInterface $removeItemToWishlist)
    {
    }

    public function __invoke(RemoveItemToWishlistCommand $command): void
    {
        $this->removeItemToWishlist->execute(new RemoveItemToWishlistRequest(
            $command->getWishlistId(),
            $command->getWishlistItemId()
        ));
    }
}
