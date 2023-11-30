<?php

declare(strict_types=1);

namespace App\Application\Http\Public\Wishlist\WishlistBasketItem;

use App\Action\Command\Wishlist\WishlistBasketItem\AddMemberToWishlistBasketItemCommand;
use App\Application\Form\Wishlist\WishlistBasketItem\AddMemberToWishlistBasketItemForm;
use App\Application\Http\CustomAbstractController;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('public/basket')]
final class AddMemberToWishlistBasketItemController extends CustomAbstractController
{
    /**
     * @throws \Exception
     */
    #[Route('/add', name: 'public_wishlist_item_basket_add', methods: ['GET', 'POST'])]
    public function __invoke(Request $request): Response
    {
        if(!$request->query->has('wishlist') || !$request->query->has('item')) {
            throw new \Exception('Not access');
        }

        $command = new AddMemberToWishlistBasketItemCommand();
        $command
            ->setWishlistMemberId('18ee0c7a-824f-415c-a5dd-bce13c4091de')
            ->setWishlistId((string)$request->query->get('wishlist'))
            ->setWishlistItemId((string)$request->query->get('item'));

        $form = $this->createForm(AddMemberToWishlistBasketItemForm::class, $command);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $this->commandBus->dispatch($command);
            } catch (\Exception $exception) {
            }
        }

        return $this->render('public/wishlist/basket/add.html.twig', [
            'form' => $form
        ]);
    }
}
