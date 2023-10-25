<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\WishlistMember;

final class GetWishlistMemberRequest
{
    public function __construct(
        private ?string $userId = null,
        private ?string $email = null
    ) {

    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
}
