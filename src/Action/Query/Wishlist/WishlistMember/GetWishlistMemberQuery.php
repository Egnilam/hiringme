<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistMember;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\WishlistMember\GetWishlistMemberRequest;

final class GetWishlistMemberQuery implements QueryInterface
{
    private GetWishlistMemberRequest $request;

    public function getRequest(): GetWishlistMemberRequest
    {
        return $this->request;
    }

    public function setRequest(GetWishlistMemberRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
