<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Query\Wishlist\GetWishlistQuery;
use App\Application\Http\CustomAbstractController;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class ShowWishlistController extends CustomAbstractController
{
    #[Route('/{id}', name: 'wishlist_show', methods: ['GET'])]
    public function __invoke(Request $request, string $id): Response
    {
        $query = new GetWishlistQuery();
        $query->setRequest(new GetWishlistRequest($id));

        $wishlist = $this->queryBus->ask($query);

        return $this->render('wishlist/show.html.twig', [
            'wishlist' => $wishlist
        ]);
    }
}
