<?php

declare(strict_types=1);

namespace App\Application\Http;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
final class MainController extends AbstractController
{
    #[Route(name: 'homepage', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        if($this->getUser()) {
            return $this->redirectToRoute('user_account');
        }

        return $this->redirectToRoute('app_login');
    }
}
