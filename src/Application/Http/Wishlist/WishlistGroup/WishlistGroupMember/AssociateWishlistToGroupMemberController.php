<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\AssociateGroupMemberToWishlistCommand;
use App\Action\Query\Wishlist\GetListWishlistQuery;
use App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember\AssociateWishlistToGroupMemberForm;
use App\Application\Http\CustomAbstractController;
use Domain\Wishlist\Request\Query\GetListWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups/{groupId}/members')]
final class AssociateWishlistToGroupMemberController extends CustomAbstractController
{
    public const NAME = 'wishlist_group_member_associate_wishlist';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $groupId, string $memberId): array
    {
        return [
            'groupId' => $groupId,
            'memberId' => $memberId
        ];
    }

    #[Route('/{memberId}/wishlist', name: self::NAME, methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $groupId, string $memberId): Response
    {
        $command = new AssociateGroupMemberToWishlistCommand();
        $command->setWishlistGroupId($groupId);

        $query = new GetListWishlistQuery();

        /** @var array<WishlistResponse> $wishlists */
        $wishlists = $this->queryBus->ask($query->setRequest(new GetListWishlistRequest($memberId)));
        if(count($wishlists) === 0) {
            return $this->redirectToRoute('wishlist_create', ['group' => $groupId]);
        }

        $form = $this->createForm(AssociateWishlistToGroupMemberForm::class, $command, ['wishlists' => $wishlists]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_group_show', ['id' => $groupId]);
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/wishlist_group/wishlist_group_member/associate_wishlist.html.twig', [
            'wishlist_group_id' => $groupId,
            'form' => $form
        ]);
    }
}
