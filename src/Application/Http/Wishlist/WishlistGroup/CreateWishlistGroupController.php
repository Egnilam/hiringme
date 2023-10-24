<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Application\Form\Wishlist\WishlistGroup\CreateWishlistGroupForm;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class CreateWishlistGroupController extends AbstractController
{
    #[Route('/create', name: 'wishlist_group_create', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, CommandBusInterface $commandBus): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $createWishlistCommand = new CreateWishlistGroupCommand();
        $createWishlistCommand->setOwner($user->getStringUuid());
        $form = $this->createForm(CreateWishlistGroupForm::class, $createWishlistCommand);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $commandBus->dispatch($createWishlistCommand);
        }

        return $this->render('wishlist/wishlist_group/create.html.twig', [
            'form' => $form,
            'domain_error' => null
        ]);
    }
}
