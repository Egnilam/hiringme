<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Query\Wishlist\WishlistGroup\GetWishlistGroupQuery;
use App\Application\Http\CustomAbstractController;
use App\Application\Presenter\Wishlist\WishlistGroup\WishlistGroupPresenter;
use App\Application\View\NavbarView;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class ShowWishlistGroupController extends CustomAbstractController
{
    public const NAME = 'wishlist_group_show';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $id): array
    {
        return ['id' => $id];
    }

    #[Route('/{id}', name: self::NAME, methods: ['GET'])]
    public function __invoke(Request $request, string $id, WishlistGroupPresenter $presenter): Response
    {
        $getWishlistGroupQuery = new GetWishlistGroupQuery();
        $getWishlistGroupQuery->setRequest(new GetWishlistGroupRequest($id));

        /** @var WishlistGroupResponse $wishlistGroup */
        $wishlistGroup = $this->queryBus->ask($getWishlistGroupQuery);

        return $this->render('wishlist/wishlist_group/show.html.twig', [
            'view' => $presenter->present($wishlistGroup),
            'wishlist_group' => $wishlistGroup,
            'navbar' => new NavbarView('groups')
        ]);
    }
}
