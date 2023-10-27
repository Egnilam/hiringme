<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Query\Wishlist\WishlistGroup\GetWishlistGroupQuery;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\WishlistGroup\GetWishlistGroupRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class ShowWishlistGroupController extends AbstractController
{
    #[Route('/{id}', name: 'wishlist_group_show', methods: ['GET'])]
    public function __invoke(Request $request, string $id, QueryBusInterface $queryBus): Response
    {

        $getWishlistGroupQuery = new GetWishlistGroupQuery();
        $getWishlistGroupQuery->setRequest(new GetWishlistGroupRequest($id));

        $wishlistGroup = $queryBus->ask($getWishlistGroupQuery);

        return $this->render('wishlist/wishlist_group/show.html.twig', [
            'wishlist_group' => $wishlistGroup
        ]);
    }
}
