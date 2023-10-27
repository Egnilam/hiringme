<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\WishlistGroup\GetWishlistGroupRequest;

final class GetWishlistGroupQuery implements QueryInterface
{
    private GetWishlistGroupRequest $request;

    public function getRequest(): GetWishlistGroupRequest
    {
        return $this->request;
    }

    public function setRequest(GetWishlistGroupRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
