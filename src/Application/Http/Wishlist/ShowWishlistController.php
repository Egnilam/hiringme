<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Query\Wishlist\GetWishlistQuery;
use App\Application\Http\CustomAbstractController;
use App\Application\Presenter\Wishlist\WishlistPresenter;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class ShowWishlistController extends CustomAbstractController
{
    public const NAME = 'wishlist_show';

    #[Route('/{id}', name: self::NAME, methods: ['GET'])]
    public function __invoke(Request $request, string $id, WishlistPresenter $presenter): Response
    {
        $query = new GetWishlistQuery();
        $query->setRequest(
            new GetWishlistRequest(
                $id,
                [
                    GetWishlistRequest::OPT_LOAD_ITEMS => true,
                    GetWishlistRequest::OPT_ITEMS_LOAD_BASKET_ITEMS => true
                ]
            )
        );

        /** @var WishlistResponse $wishlist */
        $wishlist = $this->queryBus->ask($query);

        return $this->render('wishlist/show.html.twig', [
            'wishlist' => $wishlist,
            'wishlist_view' => $presenter->present($wishlist)
        ]);
    }
}
