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

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $id, ?string $group = null): array
    {
        $params = [
            'id' => $id,
        ];

        if($group) {
            $params['group'] = $group;
        }

        return $params;
    }

    #[Route('/{id}', name: self::NAME, methods: ['GET'])]
    public function __invoke(Request $request, string $id, WishlistPresenter $presenter): Response
    {
        $wishlistGroupId = $request->query->has('group') ? (string)$request->query->get('group') : null;

        $query = new GetWishlistQuery();
        $requestOptions = [
            GetWishlistRequest::OPT_LOAD_ITEMS => true,
            GetWishlistRequest::OPT_ITEMS_LOAD_BASKET_ITEMS => true,
        ];

        if($wishlistGroupId) {
            $requestOptions[GetWishlistRequest::OPT_GROUP] = $wishlistGroupId;
        }

        $query->setRequest(
            new GetWishlistRequest($id, $requestOptions)
        );

        /** @var WishlistResponse $wishlist */
        $wishlist = $this->queryBus->ask($query);

        return $this->render('wishlist/show.html.twig', [
            'wishlist' => $wishlist,
            'wishlist_group_id' => $wishlistGroupId,
            'wishlist_view' => $presenter->present(
                $wishlist,
                $wishlistGroupId
            )
        ]);
    }
}
