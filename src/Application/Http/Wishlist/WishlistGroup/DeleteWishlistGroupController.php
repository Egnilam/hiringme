<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class DeleteWishlistGroupController extends AbstractController
{
    #[Route('/{id}', name: 'wishlist_group_delete', methods: ['DELETE'])]
    public function __invoke(Request $request, string $id): Response
    {
        return $this->redirectToRoute('wishlist_group_list');
    }
}
