<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

interface WishlistGroupMemberQueryRepositoryInterface
{
    public function emailIsAvailable(string $email, string $wishlistGroupId): bool;

    public function pseudonymIsAvailable(string $pseudonym, string $wishlistGroupId): bool;

    public function isOwner(string $id): bool;
}
