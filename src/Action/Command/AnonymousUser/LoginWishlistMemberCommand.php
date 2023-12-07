<?php

declare(strict_types=1);

namespace App\Action\Command\AnonymousUser;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

class LoginWishlistMemberCommand implements CommandInterface
{
    private string $wishlistMemberId;

    public function getWishlistMemberId(): string
    {
        return $this->wishlistMemberId;
    }

    public function setWishlistMemberId(string $wishlistMemberId): self
    {
        $this->wishlistMemberId = $wishlistMemberId;
        return $this;
    }
}
