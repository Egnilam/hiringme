<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Session\EventListener;

use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use App\Infrastructure\Framework\Session\WishlistMemberBagManager;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;

final readonly class AuthenticationSuccessSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private WishlistMemberBagManager $wishlistMemberBagManager
    ) {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationSuccessEvent::class => 'onAuthenticationSuccess',
        ];
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
        /** @var UserEntity $user */
        $user = $event->getAuthenticationToken()->getUser();

        $query = new GetWishlistMemberQuery();
        $query->setRequest(new GetWishlistMemberRequest(null, $user->getStringUuid()));

        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $this->queryBus->ask($query);

        $this->wishlistMemberBagManager->setWishlistMemberId($wishlistMemberResponse->getId());
    }
}
