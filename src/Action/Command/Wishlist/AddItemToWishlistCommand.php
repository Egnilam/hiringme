<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class AddItemToWishlistCommand extends AbstractWishlistItemCommand implements CommandInterface
{
}
