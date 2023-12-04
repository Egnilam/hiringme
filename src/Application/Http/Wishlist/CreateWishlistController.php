<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Command\Wishlist\CreateWishlistCommand;
use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Application\Form\Wishlist\CreateWishlistForm;
use App\Application\Http\CustomAbstractController;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class CreateWishlistController extends CustomAbstractController
{
    public const NAME = 'wishlist_create';

    public const QUERY_PARAM_GROUP = 'group';

    #[Route('/create', name: 'wishlist_create', methods: ['GET', 'POST'])]
    public function __invoke(Request $request): Response
    {
        /** @var UserEntity $user */
        $user = $this->getUser();

        $getWishlistMemberQuery = new GetWishlistMemberQuery();
        $getWishlistMemberQuery->setRequest(new GetWishlistMemberRequest(null, $user->getStringUuid()));
        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $this->queryBus->ask($getWishlistMemberQuery);


        $command = new CreateWishlistCommand();
        $command->setWishlistMemberId($wishlistMemberResponse->getId());

        if($request->query->has(self::QUERY_PARAM_GROUP)) {
            $command->setWishlistGroupId((string)$request->query->get(self::QUERY_PARAM_GROUP));
        }

        $form = $this->createForm(CreateWishlistForm::class, $command);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);

                return $this->redirectToRoute('wishlist_list');
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('wishlist/create.html.twig', [
            'form' => $form
        ]);
    }
}
