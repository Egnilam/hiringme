<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Session\Decorator;

use App\Infrastructure\Framework\Session\WishlistMemberBag;
use Symfony\Component\HttpFoundation\Session\SessionFactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final readonly class SessionFactoryWishlistMemberBag implements SessionFactoryInterface
{
    public function __construct(private SessionFactoryInterface $sessionFactory)
    {

    }

    public function createSession(): SessionInterface
    {
        $session = $this->sessionFactory->createSession();
        $session->registerBag(new WishlistMemberBag());
        return $session;
    }
}
