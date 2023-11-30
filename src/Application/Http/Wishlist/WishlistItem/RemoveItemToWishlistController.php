<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\RemoveItemToWishlistCommand;
use App\Application\Http\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlists/{wishlistId}/items')]
final class RemoveItemToWishlistController extends CustomAbstractController
{
    public const NAME = 'wishlist_item_remove';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $wishlistId, string $id): array
    {
        return [
            'wishlistId' => $wishlistId,
            'id' => $id
        ];
    }

    #[Route('/{id}', name: 'wishlist_item_remove', methods: ['DELETE'])]
    public function __invoke(Request $request, string $wishlistId, string $id): Response
    {
        if($this->isCsrfTokenValid(sprintf('delete.%s', $id), (string)$request->request->get('_token'))) {
            try {
                $command = new RemoveItemToWishlistCommand();
                $command
                    ->setWishlistId($wishlistId)
                    ->setWishlistItemId($id);

                $this->commandBus->dispatch($command);
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->redirectToRoute('wishlist_show', ['id' => $wishlistId]);
    }
}
