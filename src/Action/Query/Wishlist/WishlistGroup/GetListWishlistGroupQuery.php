<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\WishlistGroup\GetListWishlistGroupRequest;

final class GetListWishlistGroupQuery implements QueryInterface
{
    private GetListWishlistGroupRequest $request;

    public function getRequest(): GetListWishlistGroupRequest
    {
        return $this->request;
    }

    public function setRequest(GetListWishlistGroupRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
