<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;
use Domain\Wishlist\Domain\Model\VisibilityEnum;

final class CreateWishlistCommand extends AbstractWishlistCommand implements CommandInterface
{
}
