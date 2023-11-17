<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\UpdateItemOfWishlistInterface;
use Domain\Wishlist\Request\Command\UpdateItemOfWishlistRequest;

final readonly class UpdateItemOfWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private UpdateItemOfWishlistInterface $updateItemOfWishlist)
    {
    }

    public function __invoke(UpdateItemOfWishlistCommand $command): void
    {
        $this->updateItemOfWishlist->execute(new UpdateItemOfWishlistRequest(
            $command->getId(),
            $command->getWishlistId(),
            $command->getLabel(),
            $command->getLink(),
            $command->getDescription(),
            $command->getPriority(),
            $command->getPrice()
        ));
    }
}
