<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\AssociateGroupMemberToWishlistCommand;
use App\Action\Query\Wishlist\GetListWishlistQuery;
use App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember\AssociateWishlistToGroupMemberForm;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups/{groupId}/members')]
final class AssociateWishlistToGroupMemberController extends AbstractController
{
    #[Route('/{id}/wishlist', name: 'wishlist_group_member_associate_wishlist', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $groupId, string $id, QueryBusInterface $queryBus, CommandBusInterface $commandBus): Response {

        $command = new AssociateGroupMemberToWishlistCommand();
        $command->setWishlistGroupId($groupId);

        $query = new GetListWishlistQuery();
        $wishlists = $queryBus->ask($query->setRequest(new GetListWishlistRequest($id)));

        $form = $this->createForm(AssociateWishlistToGroupMemberForm::class, $command, ['wishlists' => $wishlists]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $commandBus->dispatch($command);
        }

        return $this->render('wishlist/wishlist_group/wishlist_group_member/associate_wishlist.html.twig', [
            'wishlist_group_id' => $groupId,
            'form' => $form
        ]);
    }
}