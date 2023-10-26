<?php

declare(strict_types=1);

namespace App\Application\Http\Security;

use App\Action\Command\User\RegisterUserCommand;
use App\Action\Command\Wishlist\WishlistMember\RegisterWishlistMemberCommand;
use App\Application\Form\User\RegisterUserForm;
use App\Application\Presenter\DomainErrorPresenter;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Common\Domain\Exception\DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
final class RegisterUserController extends AbstractController
{
    #[Route(name: 'app_register', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, EntityManagerInterface $entityManager, CommandBusInterface $commandBus): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute('user_account');
        }

        $registerUserCommand = new RegisterUserCommand();
        $form = $this->createForm(RegisterUserForm::class, $registerUserCommand);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->wrapInTransaction(function () use ($commandBus, $registerUserCommand) {
                    $commandBus->dispatch($registerUserCommand);

                    $registerWishlistMemberCommand = new RegisterWishlistMemberCommand();
                    $registerWishlistMemberCommand
                        ->setEmail($registerUserCommand->getEmail())
                        ->setRegistered(true);

                    $commandBus->dispatch($registerWishlistMemberCommand);
                });

                return $this->redirectToRoute('app_login');
            } catch (HandlerFailedException $exception) {
                $domainErrorPresenter = new DomainErrorPresenter($exception->getNestedExceptionOfClass(DomainException::class));
            } catch (\Exception $exception) {
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form,
            'domain_error' => $domainErrorPresenter ?? null,
        ]);
    }
}
