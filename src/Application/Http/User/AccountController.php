<?php

declare(strict_types=1);

namespace App\Application\Http\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account')]
final class AccountController extends AbstractController
{
    #[Route(name: 'user_account', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->render('user/account.html.twig');
    }
}
