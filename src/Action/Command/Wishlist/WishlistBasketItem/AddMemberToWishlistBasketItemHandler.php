<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist\WishlistBasketItem;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistBasketItem\AddMemberToWishlistBasketItemInterface;
use Domain\Wishlist\Request\Command\WishlistBasketItem\AddMemberToWishlistBasketItemRequest;

final readonly class AddMemberToWishlistBasketItemHandler implements CommandHandlerInterface
{
    public function __construct(private AddMemberToWishlistBasketItemInterface $addWishlistItemToWishlistMemberBasket)
    {
    }

    public function __invoke(AddMemberToWishlistBasketItemCommand $command): void
    {
        $this->addWishlistItemToWishlistMemberBasket->execute(new AddMemberToWishlistBasketItemRequest(
            $command->getUserId(),
            $command->getWishlistMemberId(),
            $command->getWishlistId(),
            $command->getWishlistItemId(),
            $command->isVisible(),
            $command->isLock()
        ));
    }
}
