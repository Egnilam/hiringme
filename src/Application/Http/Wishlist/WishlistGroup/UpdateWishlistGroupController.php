<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class UpdateWishlistGroupController extends AbstractController
{
    #[Route('/{id}/update', name: 'wishlist_group_update', methods: ['GET', 'PUT'])]
    public function __invoke(Request $request, string $id): Response
    {
        return $this->render('wishlist/wishlist_group/update.html.twig');
    }
}
