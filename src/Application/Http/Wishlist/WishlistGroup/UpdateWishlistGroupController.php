<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\UpdateWishlistGroupCommand;
use App\Action\Query\Wishlist\WishlistGroup\GetWishlistGroupQuery;
use App\Application\Form\Wishlist\WishlistGroup\UpdateWishlistGroupForm;
use App\Application\Http\CustomAbstractController;
use App\Application\View\NavbarView;
use Domain\Wishlist\Request\Query\WishlistGroup\GetWishlistGroupRequest;
use Domain\Wishlist\Response\WishlistGroupResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class UpdateWishlistGroupController extends CustomAbstractController
{
    public const NAME = 'wishlist_group_update';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $id): array
    {
        return ['id' => $id];
    }

    #[Route('/{id}/update', name: 'wishlist_group_update', methods: ['GET', 'PUT'])]
    public function __invoke(Request $request, string $id): Response
    {
        $query = new GetWishlistGroupQuery();
        /** @var WishlistGroupResponse $wishlistGroup */
        $wishlistGroup = $this->queryBus->ask($query->setRequest(new GetWishlistGroupRequest($id)));
        $command = new UpdateWishlistGroupCommand();
        $command
            ->setId($wishlistGroup->getId())
            ->setName($wishlistGroup->getName());

        $form = $this->createForm(UpdateWishlistGroupForm::class, $command, ['method' => 'PUT']);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_group_list');
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/wishlist_group/update.html.twig', [
            'form' => $form,
            'navbar' => new NavbarView('groups')
        ]);
    }
}
