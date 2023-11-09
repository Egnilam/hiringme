<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Command\Wishlist\DeleteWishlistCommand;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class DeleteWishlistController extends AbstractController
{
    #[Route('/{id}', name: 'wishlist_delete', methods: ['DELETE'])]
    public function __invoke(Request $request, string $id, CommandBusInterface $commandBus): Response
    {
        if($this->isCsrfTokenValid(sprintf('delete.%s', $id), (string)$request->request->get('_token'))) {
            try {
                $command = new DeleteWishlistCommand();
                $command
                    ->setId($id);

                $commandBus->dispatch($command);
            } catch (\Exception $exception) {

            }
        }

        return $this->redirectToRoute('wishlist_list');
    }
}
