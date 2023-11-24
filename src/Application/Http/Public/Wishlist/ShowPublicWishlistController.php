<?php

declare(strict_types=1);

namespace App\Application\Http\Public\Wishlist;

use App\Action\Query\Wishlist\GetWishlistQuery;
use App\Application\Http\CustomAbstractController;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('public/wishlists')]
final class ShowPublicWishlistController extends CustomAbstractController
{
    #[Route('/{id}', name: 'public_wishlist_show', methods: ['GET'])]
    public function __invoke(Request $request, string $id): Response
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

        $wishlist = $this->queryBus->ask($query);

        return $this->render('public/wishlist/show.html.twig', [
            'wishlist' => $wishlist
        ]);
    }
}
