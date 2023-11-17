<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\UpdateWishlistInterface;
use Domain\Wishlist\Request\Command\UpdateWishlistRequest;

final readonly class UpdateWishlistHandler implements CommandHandlerInterface
{
    public function __construct(private UpdateWishlistInterface $updateWishlist)
    {
    }

    public function __invoke(UpdateWishlistCommand $command): void
    {
        $this->updateWishlist->execute(new UpdateWishlistRequest(
            $command->getId(),
            $command->getWishlistMemberId(),
            $command->getName(),
            $command->getVisibility()
        ));
    }
}
