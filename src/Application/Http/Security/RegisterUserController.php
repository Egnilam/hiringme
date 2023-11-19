<?php

declare(strict_types=1);

namespace App\Application\Http\Security;

use App\Action\Command\User\RegisterUserCommand;
use App\Action\Command\Wishlist\WishlistMember\RegisterWishlistMemberCommand;
use App\Application\Form\User\RegisterUserForm;
use App\Application\Http\CustomAbstractController;
use App\Application\Presenter\DomainErrorPresenter;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Common\Domain\Exception\DomainException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
final class RegisterUserController extends CustomAbstractController
{
    #[Route(name: 'app_register', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute('user_account');
        }

        $registerUserCommand = new RegisterUserCommand();
        $form = $this->createForm(RegisterUserForm::class, $registerUserCommand);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->wrapInTransaction(function () use ($registerUserCommand) {
                    $this->commandBus->dispatch($registerUserCommand);

                    $registerWishlistMemberCommand = new RegisterWishlistMemberCommand();
                    $registerWishlistMemberCommand
                        ->setEmail($registerUserCommand->getEmail())
                        ->setRegistered(true);

                    $this->commandBus->dispatch($registerWishlistMemberCommand);
                });

                return $this->redirectToRoute('app_login');
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form,
        ]);
    }
}
