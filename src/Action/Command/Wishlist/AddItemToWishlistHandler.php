<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\AddItemToWishlistInterface;
use Domain\Wishlist\Request\Command\AddItemToWishlistRequest;

final readonly class AddItemToWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private AddItemToWishlistInterface $addItemToWishlist)
    {
    }

    public function __invoke(AddItemToWishlistCommand $command): void
    {
        $this->addItemToWishlist->execute(new AddItemToWishlistRequest(
            $command->getWishlistId(),
            $command->getLabel(),
            $command->getLink(),
            $command->getDescription(),
            $command->getPriority(),
            $command->getPrice()
        ));
    }
}
