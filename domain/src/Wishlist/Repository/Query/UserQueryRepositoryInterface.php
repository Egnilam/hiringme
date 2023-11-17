<?php

declare(strict_types=1);

namespace Domain\Wishlist\Repository\Query;

interface UserQueryRepositoryInterface
{
    public function searchUserIdByEmail(string $email): string;
}
