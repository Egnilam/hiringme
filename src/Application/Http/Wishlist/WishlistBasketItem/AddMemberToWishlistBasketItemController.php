<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistBasketItem;

use App\Action\Command\Wishlist\WishlistBasketItem\AddMemberToWishlistBasketItemCommand;
use App\Application\Form\Wishlist\WishlistBasketItem\AddMemberToWishlistBasketItemForm;
use App\Application\Http\CustomAbstractController;
use App\Application\Http\Wishlist\ShowWishlistController;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlists/{wishlistId}/items')]
final class AddMemberToWishlistBasketItemController extends CustomAbstractController
{
    public const NAME = 'wishlist_basket_item_add_member';

    /**
     * @return array<string>
     */
    public static function getRequestParams(
        string $wishlistId,
        string $id,
        ?string $group = null
    ): array {
        $params = [
            'wishlistId' => $wishlistId,
            'id' => $id,
        ];

        if($group) {
            $params['group'] = $group;
        }

        return $params;
    }

    #[Route('/{id}/basket', name: self::NAME, methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $wishlistId, string $id, GetClaimantWishlistMemberIdInterface $getClaimantWishlistMemberId): Response
    {
        $claimantWishlistMemberId = $getClaimantWishlistMemberId->get();

        $wishlistGroupId = $request->query->has('group') ? (string)$request->query->get('group') : null;

        $command = new AddMemberToWishlistBasketItemCommand();
        $command
            ->setWishlistMemberId($claimantWishlistMemberId)
            ->setWishlistId($wishlistId)
            ->setWishlistItemId($id)
            ->setWishlistGroupId($wishlistGroupId);

        $form = $this->createForm(AddMemberToWishlistBasketItemForm::class, $command);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute(ShowWishlistController::NAME, ShowWishlistController::getRequestParams($wishlistId, $wishlistGroupId));
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/wishlist_basket_item/add.html.twig', [
            'form' => $form
        ]);
    }
}
