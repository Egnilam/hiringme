<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandHandlerInterface;
use Domain\Wishlist\Port\Command\WishlistMember\RegisterWishlistMemberInterface;
use Domain\Wishlist\Request\RegisterWishlistMemberRequest;

final readonly class RegisterWishlistMemberHandler implements CommandHandlerInterface
{
    public function __construct(private RegisterWishlistMemberInterface $registerWishlistMember)
    {

    }

    public function __invoke(RegisterWishlistMemberCommand $command): void
    {
        $request = new RegisterWishlistMemberRequest(
            $command->getEmail(),
            $command->isRegistered()
        );

        $this->registerWishlistMember->execute($request);
    }
}
