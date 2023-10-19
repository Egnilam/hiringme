<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\RegisterWishlistMemberInterface;
use Domain\Wishlist\Request\RegisterWishlistMemberRequest;

final readonly class RegisterWishlistMemberHandler implements CommandHandlerInterface
{
    public function __construct(private RegisterWishlistMemberInterface $registerWishlistMember)
    {

    }

    public function __invoke(RegisterWishlistMemberCommand $registerWishlistMemberCommand): void
    {
        $registerWishlistMemberRequest = new RegisterWishlistMemberRequest(
            $registerWishlistMemberCommand->getEmail(),
            $registerWishlistMemberCommand->isRegistered()
        );

        $this->registerWishlistMember->execute($registerWishlistMemberRequest);
    }
}
