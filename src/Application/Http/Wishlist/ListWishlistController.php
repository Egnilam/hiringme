<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Query\Wishlist\GetListWishlistQuery;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class ListWishlistController extends AbstractController
{
    #[Route(name: 'wishlist_list', methods: ['GET'])]
    public function __invoke(Request $request, QueryBusInterface $queryBus): Response
    {

        $query = new GetListWishlistQuery();
        $query->setRequest(new GetListWishlistRequest());

        $wishlists = $queryBus->ask($query);

        return $this->render('wishlist/list.html.twig', [
            'wishlists' => $wishlists
        ]);
    }
}
