<?php

declare(strict_types=1);

namespace App\Application\Components\Wishlist;

use Domain\Wishlist\Response\WishlistResponse;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class WishlistItemsComponent
{
    use DefaultActionTrait;

    #[LiveProp(useSerializerForHydration: true)]
    public WishlistResponse $wishlist;
}
