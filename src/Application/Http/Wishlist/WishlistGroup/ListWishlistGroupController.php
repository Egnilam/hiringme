<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class ListWishlistGroupController extends AbstractController
{
    #[Route(name: 'wishlist_group_list', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        return $this->render('wishlist/wishlist_group/list.html.twig');
    }
}
