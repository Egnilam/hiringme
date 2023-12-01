<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Query\Wishlist\GetListWishlistQuery;
use App\Application\Http\CustomAbstractController;
use App\Application\Presenter\Wishlist\WishlistPresenter;
use App\Application\View\LinkView;
use App\Application\View\Wishlist\ListWishlistView;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class ListWishlistController extends CustomAbstractController
{
    #[Route(name: 'wishlist_list', methods: ['GET'])]
    public function __invoke(Request $request, WishlistPresenter $wishlistPresenter, GetClaimantWishlistMemberIdInterface $getClaimantWishlistMemberId): Response
    {
        $query = new GetListWishlistQuery();
        $query->setRequest(new GetListWishlistRequest($getClaimantWishlistMemberId->get()));

        /** @var array<WishlistResponse> $wishlists */
        $wishlists = $this->queryBus->ask($query);

        $view = new ListWishlistView(
            $wishlists,
            new LinkView('ui.wishlist.create', $this->generateUrl('wishlist_create'))
        );

        return $this->render('wishlist/list.html.twig', [
            'view' => $view
        ]);
    }
}
