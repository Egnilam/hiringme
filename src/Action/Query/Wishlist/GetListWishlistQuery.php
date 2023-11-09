<?php

declare(strict_types=1);

namespace App\Action\Query\Wishlist;

use App\Infrastructure\Framework\Messenger\Query\QueryInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;

final class GetListWishlistQuery implements QueryInterface
{
    private GetListWishlistRequest $request;

    public function getRequest(): GetListWishlistRequest
    {
        return $this->request;
    }

    public function setRequest(GetListWishlistRequest $request): self
    {
        $this->request = $request;
        return $this;
    }
}
