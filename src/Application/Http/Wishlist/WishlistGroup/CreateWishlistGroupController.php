<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberCommand;
use App\Application\Form\Wishlist\WishlistGroup\CreateWishlistGroupForm;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
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

        $createWishlistCommand = new CreateWishlistGroupCommand();
        $wishlistGroupMemberCommand = new CreateWishlistGroupMemberCommand();
        $wishlistGroupMemberCommand
            ->setOwner(true)
            ->setEmail($user->getEmail())
            ->setPseudonym($user->getPerson()->getFirstName());

        $createWishlistCommand->setMembers([$wishlistGroupMemberCommand, new CreateWishlistGroupMemberCommand()]);
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
