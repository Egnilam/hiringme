<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\RemoveItemToWishlistCommand;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlists/{wishlistId}/items')]
final class RemoveItemToWishlistController extends AbstractController
{
    #[Route('/{id}', name: 'wishlist_item_remove', methods: ['DELETE'])]
    public function __invoke(Request $request, string $wishlistId, string $id, CommandBusInterface $commandBus): Response
    {
        if($this->isCsrfTokenValid(sprintf('remove.%s', $id), (string)$request->request->get('_token'))) {
            try {
                $command = new RemoveItemToWishlistCommand();
                $command
                    ->setWishlistId($wishlistId)
                    ->setWishlistItemId($id);

                $commandBus->dispatch($command);
            } catch (\Exception $exception) {

            }
        }

        return $this->redirectToRoute('wishlist_show', ['id' => $wishlistId]);
    }
}
