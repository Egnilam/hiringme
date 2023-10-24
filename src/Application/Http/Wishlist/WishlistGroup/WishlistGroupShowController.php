<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class WishlistGroupShowController extends AbstractController
{
    #[Route('/{id}', name: 'wishlist_group_show', methods: ['GET'])]
    public function __invoke(Request $request, string $id): Response
    {
        return $this->render('wishlist/wishlist_group/show.html.twig');
    }
}
