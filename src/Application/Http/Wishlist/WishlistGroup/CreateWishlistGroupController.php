<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Application\View\NavbarView;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class CreateWishlistGroupController extends AbstractController
{
    #[Route('/create', name: 'wishlist_group_create', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->render('wishlist/wishlist_group/create.html.twig', [
            'navbar' => new NavbarView('groups')
        ]);
    }
}
