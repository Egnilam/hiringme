<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\Query\GetWishlistRequest;

final class GetWishlistQuery implements QueryInterface
{
    private GetWishlistRequest $request;

    public function getRequest(): GetWishlistRequest
    {
        return $this->request;
    }

    public function setRequest(GetWishlistRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
