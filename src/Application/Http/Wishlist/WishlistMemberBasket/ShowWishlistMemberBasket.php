<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistMemberBasket;

use App\Action\Query\Wishlist\WishlistMemberBasket\GetWishlistMemberBasketQuery;
use App\Application\Http\CustomAbstractController;
use App\Application\View\NavbarView;
use Domain\Wishlist\Request\Query\WishlistMemberBasket\GetWishlistMemberBasketRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('basket')]
final class ShowWishlistMemberBasket extends CustomAbstractController
{
    #[Route(name: 'wishlist_member_basket_show', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        $query = new GetWishlistMemberBasketQuery();
        $query->setRequest(new GetWishlistMemberBasketRequest('18ee0c7a-824f-415c-a5dd-bce13c4091de'));

        $wishlistMemberBasket = $this->queryBus->ask($query);

        return $this->render('wishlist/wishlist_member_basket/show.html.twig', [
            'navbar' => new NavbarView('basket'),
            'wishlist_member_basket' => $wishlistMemberBasket
        ]);
    }
}
