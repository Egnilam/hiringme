<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\UpdateItemOfWishlistCommand;
use App\Action\Query\Wishlist\WishlistItem\GetWishlistItemQuery;
use App\Application\Form\Wishlist\WishlistItem\UpdateItemOfWishlistForm;
use App\Application\Http\CustomAbstractController;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Domain\Model\PriorityEnum;
use Domain\Wishlist\Request\Query\WishlistItem\GetWishlistItemRequest;
use Domain\Wishlist\Response\WishlistItemResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlists/{wishlistId}/items')]
final class UpdateItemOfWishlistController extends CustomAbstractController
{
    #[Route('/{id}/update', name: 'wishlist_item_update', methods: ['GET', 'PUT'])]
    public function __invoke(Request $request, string $wishlistId, string $id): Response
    {

        $query = new GetWishlistItemQuery();
        $query->setRequest(new GetWishlistItemRequest($id));

        /** @var WishlistItemResponse $wishlistItem */
        $wishlistItem = $this->queryBus->ask($query);

        $command = $this->createCommand($wishlistItem, $wishlistId);

        $form = $this->createForm(UpdateItemOfWishlistForm::class, $command, ['method' => 'PUT']);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_show', ['id' => $wishlistId]);
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }
        return $this->render('wishlist/wishlist_item/update.html.twig', [
            'wishlist_id' => $wishlistId,
            'form' => $form
        ]);
    }

    private function createCommand(WishlistItemResponse $wishlistItem, string $wishlistId): UpdateItemOfWishlistCommand
    {
        $command = new UpdateItemOfWishlistCommand();
        $command
            ->setId($wishlistItem->getId())
            ->setWishlistId($wishlistId)
            ->setLabel($wishlistItem->getLabel())
            ->setLink($wishlistItem->getLink())
            ->setDescription($wishlistItem->getDescription())
            ->setPriority($wishlistItem->getPriority() ? PriorityEnum::from($wishlistItem->getPriority()) : null)
            ->setPrice($wishlistItem->getPrice());

        return $command;
    }
}
