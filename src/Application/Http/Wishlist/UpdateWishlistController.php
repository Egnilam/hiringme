<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Command\Wishlist\UpdateWishlistCommand;
use App\Action\Query\Wishlist\GetWishlistQuery;
use App\Application\Form\Wishlist\UpdateWishlistForm;
use App\Application\Http\CustomAbstractController;
use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Domain\Wishlist\Request\Query\GetWishlistRequest;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class UpdateWishlistController extends CustomAbstractController
{
    #[Route('/{id}/update', name: 'wishlist_update', methods: ['GET', 'PUT'])]
    public function __invoke(Request $request, string $id): Response
    {
        $query = new GetWishlistQuery();
        /** @var WishlistResponse $wishlist */
        $wishlist = $this->queryBus->ask($query->setRequest(new GetWishlistRequest($id)));

        $command = new UpdateWishlistCommand();
        $command
            ->setId($wishlist->getId())
            ->setWishlistMemberId($wishlist->getWishlistMemberId())
            ->setName($wishlist->getName())
            ->setVisibility(VisibilityEnum::from($wishlist->getVisibility()));

        $form = $this->createForm(UpdateWishlistForm::class, $command, ['method' => 'PUT']);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_list');
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/update.html.twig', [
            'form' => $form
        ]);
    }
}
