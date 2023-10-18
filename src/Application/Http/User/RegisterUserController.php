<?php

declare(strict_types=1);

namespace App\Application\Http\User;

use App\Action\Command\User\RegisterUserCommand;
use App\Application\Form\User\RegisterUserForm;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/register')]
final class RegisterUserController extends AbstractController
{
    #[Route(name: 'user_register', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, CommandBusInterface $commandBus): Response {
        $registerUserCommand = new RegisterUserCommand();
        $form = $this->createForm(RegisterUserForm::class, $registerUserCommand);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                try{
                    $commandBus->dispatch($registerUserCommand);
                } catch (\Exception $exception){
                }
            }
        }

        return $this->render('user/register.html.twig', [
            'form' => $form
        ]);
    }
}