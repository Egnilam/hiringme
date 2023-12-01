<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\AddItemToWishlistCommand;
use App\Application\Form\Wishlist\WishlistItem\AddItemToWishlistForm;
use App\Application\Http\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlists/{wishlistId}/items')]
final class AddItemToWishlistController extends CustomAbstractController
{
    public const NAME = 'wishlist_item_add';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $wishlistId): array
    {
        return [
          'wishlistId' => $wishlistId
        ];
    }

    #[Route('/add', name: self::NAME, methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $wishlistId): Response
    {
        $command = new AddItemToWishlistCommand();
        $command->setWishlistId($wishlistId);

        $form = $this->createForm(AddItemToWishlistForm::class, $command);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_show', ['id' => $wishlistId]);
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/wishlist_item/add.html.twig', [
            'wishlist_id' => $wishlistId,
            'form' => $form
        ]);
    }
}
