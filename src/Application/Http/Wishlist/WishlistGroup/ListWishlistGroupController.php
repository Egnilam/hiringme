<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Query\Wishlist\WishlistGroup\GetListWishlistGroupQuery;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\WishlistGroup\GetListWishlistGroupRequest;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class ListWishlistGroupController extends AbstractController
{
    #[Route(name: 'wishlist_group_list', methods: ['GET'])]
    public function __invoke(Request $request, QueryBusInterface $queryBus): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest($user->getStringUuid()));
        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $queryBus->ask($getWishlistMemberQuery);

        $getListWishlistGroupQuery = new GetListWishlistGroupQuery();
        $getListWishlistGroupQuery->setRequest(new GetListWishlistGroupRequest($wishlistMemberResponse->getId()));

        $wishlistGroups = $queryBus->ask($getListWishlistGroupQuery);

        return $this->render('wishlist/wishlist_group/list.html.twig', [
            'wishlist_groups' => $wishlistGroups
        ]);
    }
}
