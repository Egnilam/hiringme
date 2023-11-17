<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistItem;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\Query\WishlistItem\GetWishlistItemRequest;

final class GetWishlistItemQuery implements QueryInterface
{
    private GetWishlistItemRequest $request;

    public function getRequest(): GetWishlistItemRequest
    {
        return $this->request;
    }

    public function setRequest(GetWishlistItemRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
