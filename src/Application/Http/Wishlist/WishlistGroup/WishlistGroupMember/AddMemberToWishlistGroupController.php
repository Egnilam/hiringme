<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\WishlistGroup\AddMemberToWishlistGroupCommand;
use App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberForm;
use App\Application\Http\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups/{groupId}/members')]
final class AddMemberToWishlistGroupController extends CustomAbstractController
{
    public const NAME = 'wishlist_group_member_add';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $groupId): array
    {
        return ['groupId' => $groupId];
    }

    #[Route('/add', name: self::NAME, methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $groupId): Response
    {
        $addWishlistGroupMemberCommand =  new AddMemberToWishlistGroupCommand();

        $form = $this->createForm(AddWishlistGroupMemberForm::class, $addWishlistGroupMemberCommand);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $addWishlistGroupMemberCommand->setWishlistGroupId($groupId);

            try {
                $this->commandBus->dispatch($addWishlistGroupMemberCommand);

                return $this->redirectToRoute('wishlist_group_show', ['id' => $groupId]);

            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/wishlist_group/wishlist_group_member/add.html.twig', [
            'wishlist_group_id' => $groupId,
            'form' => $form
        ]);
    }
}
