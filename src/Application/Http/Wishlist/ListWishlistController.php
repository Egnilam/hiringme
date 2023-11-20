<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Query\Wishlist\GetListWishlistQuery;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Application\Http\CustomAbstractController;
use App\Application\View\LinkItemView;
use App\Application\View\NavbarView;
use App\Application\View\Wishlist\ListWishlistView;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class ListWishlistController extends CustomAbstractController
{
    #[Route(name: 'wishlist_list', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest($user->getStringUuid()));

        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $this->queryBus->ask($getWishlistMemberQuery);

        $query = new GetListWishlistQuery();
        $query->setRequest(new GetListWishlistRequest($wishlistMemberResponse->getId()));

        /** @var array<WishlistResponse> $wishlists */
        $wishlists = $this->queryBus->ask($query);

        $view = new ListWishlistView(
            $wishlists,
            new LinkItemView('ui.wishlist.create', $this->generateUrl('wishlist_create'))
        );

        return $this->render('wishlist/list.html.twig', [
            'view' => $view
        ]);
    }
}
