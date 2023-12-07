<?php

declare(strict_types=1);

namespace App\Action\Command\AnonymousUser;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use App\Infrastructure\Framework\Session\WishlistMemberBagManager;

final readonly class LoginWishlistMemberHandler implements CommandHandlerInterface
{
    public function __construct(private WishlistMemberBagManager $wishlistMemberBagManager)
    {
    }

    public function __invoke(LoginWishlistMemberCommand $chooseWishlistMemberCommand): void
    {
        $this->wishlistMemberBagManager->setWishlistMemberId($chooseWishlistMemberCommand->getWishlistMemberId());
    }
}
