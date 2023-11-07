<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Command\Wishlist\CreateWishlistCommand;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Application\Form\Wishlist\CreateWishlistForm;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class CreateWishlistController extends AbstractController
{
    #[Route('/create', name: 'wishlist_create', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, CommandBusInterface $commandBus, QueryBusInterface $queryBus): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest($user->getStringUuid()));
        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $queryBus->ask($getWishlistMemberQuery);


        $command = new CreateWishlistCommand();
        $command->setWishlistMemberId($wishlistMemberResponse->getId());

        $form = $this->createForm(CreateWishlistForm::class, $command);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $commandBus->dispatch($command);
            } catch (\Exception $exception) {

            }
        }

        return $this->render('wishlist/create.html.twig', [
            'form' => $form
        ]);
    }
}
