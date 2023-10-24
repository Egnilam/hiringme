<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;

final readonly class CreateWishlistGroupHandler implements CommandHandlerInterface
{
    public function __invoke(CreateWishlistGroupCommand $createWishlistGroupCommand): void
    {
        dump($createWishlistGroupCommand);
    }
}
