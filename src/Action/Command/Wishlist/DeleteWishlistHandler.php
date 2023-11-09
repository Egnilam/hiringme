<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\DeleteWishlistInterface;
use Domain\Wishlist\Request\Command\DeleteWishlistRequest;

final readonly class DeleteWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private DeleteWishlistInterface $deleteWishlist)
    {
    }

    public function __invoke(DeleteWishlistCommand $command): void
    {
        $this->deleteWishlist->execute(new DeleteWishlistRequest($command->getId()));
    }
}
