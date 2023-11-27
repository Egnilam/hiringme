<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist\WishlistMemberBasket;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\Query\WishlistMemberBasket\GetWishlistMemberBasketRequest;

final class GetWishlistMemberBasketQuery implements QueryInterface
{
    private GetWishlistMemberBasketRequest $request;

    public function getRequest(): GetWishlistMemberBasketRequest
    {
        return $this->request;
    }

    public function setRequest(GetWishlistMemberBasketRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
