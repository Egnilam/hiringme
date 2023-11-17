<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\WishlistGroup\RemoveMemberToWishlistGroupCommand;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups/{groupId}/members')]
final class RemoveMemberToWishlistGroupController extends AbstractController
{
    #[Route('/{id}', name: 'wishlist_group_member_remove', methods: ['DELETE'])]
    public function __invoke(Request $request, string $groupId, string $id, CommandBusInterface $commandBus): Response
    {
        if($this->isCsrfTokenValid(sprintf('remove.%s', $id), (string)$request->request->get('_token'))) {
            try {
                $command = new RemoveMemberToWishlistGroupCommand();
                $command
                    ->setClaimantId('claimant id')
                    ->setWishlistGroupId($groupId)
                    ->setWishlistGroupMemberId($id);

                $commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_group_show', ['id' => $groupId]);
            } catch (\Exception $exception) {
            }

        }

        return $this->redirect((string)$request->headers->get('referer'));
    }
}
