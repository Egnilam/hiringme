<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Application\Form\Wishlist\WishlistGroup\CreateWishlistGroupForm;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class CreateWishlistGroupController extends AbstractController
{
    #[Route('/create', name: 'wishlist_group_create', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, CommandBusInterface $commandBus, QueryBusInterface $queryBus): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest($user->getStringUuid()));
        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $queryBus->ask($getWishlistMemberQuery);

        $createWishlistCommand = new CreateWishlistGroupCommand();
        $createWishlistCommand->setOwner($wishlistMemberResponse->getId());
        $form = $this->createForm(CreateWishlistGroupForm::class, $createWishlistCommand);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $commandBus->dispatch($createWishlistCommand);

            return $this->redirectToRoute('wishlist_group_list');
        }

        return $this->render('wishlist/wishlist_group/create.html.twig', [
            'form' => $form,
            'domain_error' => null
        ]);
    }
}
