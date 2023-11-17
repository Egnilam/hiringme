<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\UpdateWishlistGroupCommand;
use App\Action\Query\Wishlist\WishlistGroup\GetWishlistGroupQuery;
use App\Application\Form\Wishlist\WishlistGroup\UpdateWishlistGroupForm;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class UpdateWishlistGroupController extends AbstractController
{
    #[Route('/{id}/update', name: 'wishlist_group_update', methods: ['GET', 'PUT'])]
    public function __invoke(Request $request, string $id, QueryBusInterface $queryBus, CommandBusInterface $commandBus): Response
    {
        $query = new GetWishlistGroupQuery();
        /** @var WishlistGroupResponse $wishlistGroup */
        $wishlistGroup = $queryBus->ask($query->setRequest(new GetWishlistGroupRequest($id)));
        $command = new UpdateWishlistGroupCommand();
        $command
            ->setId($wishlistGroup->getId())
            ->setName($wishlistGroup->getName());

        $form = $this->createForm(UpdateWishlistGroupForm::class, $command, ['method' => 'PUT']);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_group_list');
            } catch (\Exception $exception) {

            }
        }

        return $this->render('wishlist/wishlist_group/update.html.twig', [
            'form' => $form,
        ]);
    }
}
