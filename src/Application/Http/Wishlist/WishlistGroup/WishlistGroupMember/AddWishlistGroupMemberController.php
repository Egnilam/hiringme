<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberCommand;
use App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberForm;
use App\Application\Presenter\DomainErrorPresenter;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Domain\Common\Domain\Exception\DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups/{groupId}/members')]
final class AddWishlistGroupMemberController extends AbstractController
{
    #[Route('/add', name: 'wishlist_group_member_add', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, string $groupId, CommandBusInterface $commandBus): Response
    {
        $addWishlistGroupMemberCommand =  new AddWishlistGroupMemberCommand();

        $form = $this->createForm(AddWishlistGroupMemberForm::class, $addWishlistGroupMemberCommand);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $addWishlistGroupMemberCommand->setWishlistGroupId($groupId);

            try {
                $commandBus->dispatch($addWishlistGroupMemberCommand);

                return $this->redirectToRoute('wishlist_group_show', ['id' => $groupId]);

            } catch (HandlerFailedException $exception) {
                $domainErrorPresenter = new DomainErrorPresenter($exception->getNestedExceptionOfClass(DomainException::class));
            } catch (\Exception $exception) {
            }
        }

        return $this->render('wishlist/wishlist_group/wishlist_group_member/add.html.twig', [
            'wishlist_group_id' => $groupId,
            'domain_error' => $domainErrorPresenter ?? null,
            'form' => $form
        ]);
    }
}
