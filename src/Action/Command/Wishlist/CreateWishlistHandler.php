<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\CreateWishlistInterface;
use Domain\Wishlist\Request\Command\CreateWishlistRequest;

final readonly class CreateWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private CreateWishlistInterface $createWishlist)
    {
    }

    public function __invoke(CreateWishlistCommand $command): void
    {
        $this->createWishlist->execute(new CreateWishlistRequest(
            $command->getWishlistMemberId(),
            $command->getName(),
            $command->getVisibility()
        ));
    }
}
