<?php

declare(strict_types=1);

namespace App\Application\Http;

use App\Action\Command\Company\RegisterCompanyCommand;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
final class HomeController extends AbstractController
{
    #[Route(name: 'home')]
    public function __invoke(Request $request, CommandBusInterface $commandBus): Response {

        $commandBus->dispatch(new RegisterCompanyCommand('hiringme'));

        return new Response('test');
    }
}