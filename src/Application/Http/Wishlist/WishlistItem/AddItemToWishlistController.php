<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\AddItemToWishlistCommand;
use App\Application\Form\Wishlist\WishlistItem\AddItemToWishlistForm;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlists/{wishlistId}/items')]
final class AddItemToWishlistController extends AbstractController
{
    #[Route('/add', name: 'wishlist_item_add', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $wishlistId, CommandBusInterface $commandBus): Response
    {
        $command = new AddItemToWishlistCommand();
        $command->setWishlistId($wishlistId);

        $form = $this->createForm(AddItemToWishlistForm::class, $command);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_show', ['id' => $wishlistId]);
            } catch (\Exception $exception) {

            }
        }

        return $this->render('wishlist/wishlist_item/add.html.twig', [
            'wishlist_id' => $wishlistId,
            'form' => $form
        ]);
    }
}
