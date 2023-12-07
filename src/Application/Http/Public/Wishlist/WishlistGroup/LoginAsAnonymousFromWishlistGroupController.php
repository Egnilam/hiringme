<?php

declare(strict_types=1);

namespace App\Application\Http\Public\Wishlist\WishlistGroup;

use App\Action\Command\AnonymousUser\LoginWishlistMemberCommand;
use App\Action\Query\Wishlist\WishlistGroup\GetWishlistGroupQuery;
use App\Application\Form\AnonymousUser\LoginWishlistMemberForm;
use App\Application\Http\CustomAbstractController;
use App\Application\Http\Wishlist\WishlistGroup\ShowWishlistGroupController;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupMemberResponse;
use Domain\Wishlist\Response\WishlistGroupResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('public/wishlist_groups')]
class LoginAsAnonymousFromWishlistGroupController extends CustomAbstractController
{
    public const NAME = 'public_wishlist_group_login';

    #[Route('/{id}/login', name: self::NAME, methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $id): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute(
                ShowWishlistGroupController::NAME,
                ShowWishlistGroupController::getRequestParams($id),
            );
        }

        $query = new GetWishlistGroupQuery();
        $query->setRequest(new GetWishlistGroupRequest($id));

        /** @var WishlistGroupResponse $wishlistGroup */
        $wishlistGroup = $this->queryBus->ask($query);

        $command = new LoginWishlistMemberCommand();
        $form = $this->createForm(LoginWishlistMemberForm::class, $command, ['members' => $wishlistGroup->getMembers()]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $wishlistGroupMembers = array_values(
                array_filter(
                    $wishlistGroup->getMembers(),
                    fn (WishlistGroupMemberResponse $wishlistGroupMember) => $command->getWishlistMemberId() === $wishlistGroupMember->getWishlistMemberId()
                )
            );

            if($wishlistGroupMembers[0]->isWishlistMemberRegistered()) {
                return $this->redirectToRoute('app_login');
            }

            $this->commandBus->dispatch($command);
            dump($request->getSession());
        }

        return $this->render('public/wishlist/wishlist_group/login_as_anonymous_from_wishlist_group.html.twig', [
            'form' => $form
        ]);
    }
}
