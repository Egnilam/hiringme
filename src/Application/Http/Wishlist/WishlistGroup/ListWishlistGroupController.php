<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Query\Wishlist\WishlistGroup\GetListWishlistGroupQuery;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Application\Http\CustomAbstractController;
use App\Application\View\NavbarView;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use Domain\Wishlist\Request\Query\WishlistGroup\GetListWishlistGroupRequest;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class ListWishlistGroupController extends CustomAbstractController
{
    public const NAME = 'wishlist_group_list';

    #[Route(name: self::NAME, methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest(null, $user->getStringUuid()));
        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $this->queryBus->ask($getWishlistMemberQuery);

        $getListWishlistGroupQuery = new GetListWishlistGroupQuery();
        $getListWishlistGroupQuery->setRequest(new GetListWishlistGroupRequest($wishlistMemberResponse->getId()));

        $wishlistGroups = $this->queryBus->ask($getListWishlistGroupQuery);

        return $this->render('wishlist/wishlist_group/list.html.twig', [
            'wishlist_groups' => $wishlistGroups,
            'navbar' => new NavbarView('groups')
        ]);
    }
}
