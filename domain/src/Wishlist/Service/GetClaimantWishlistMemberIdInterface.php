<?php

declare(strict_types=1);

namespace Domain\Wishlist\Service;

interface GetClaimantWishlistMemberIdInterface
{
    public function get(): string;
}
