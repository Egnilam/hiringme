<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Query\Wishlist\GetListWishlistQuery;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
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
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest($user->getStringUuid()));
        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $queryBus->ask($getWishlistMemberQuery);

        $query = new GetListWishlistQuery();
        $query->setRequest(new GetListWishlistRequest($wishlistMemberResponse->getId()));

        $wishlists = $queryBus->ask($query);

        return $this->render('wishlist/list.html.twig', [
            'wishlists' => $wishlists
        ]);
    }
}
