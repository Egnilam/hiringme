<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class CreateWishlistGroupController extends AbstractController
{
    #[Route('/create', name: 'wishlist_group_create', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, CommandBusInterface $commandBus, QueryBusInterface $queryBus): Response
    {
        return $this->render('wishlist/wishlist_group/create.html.twig', [
            'domain_error' => null
        ]);
    }
}
