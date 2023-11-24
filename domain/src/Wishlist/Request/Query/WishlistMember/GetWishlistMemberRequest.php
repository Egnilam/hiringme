<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query\WishlistMember;

final readonly class GetWishlistMemberRequest
{
    public function __construct(
        private ?string $id = null,
        private ?string $userId = null,
        private ?string $email = null
    ) {

    }

    public function getId(): ?string
    {
        return $this->id;
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
