<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Session;

use App\Action\Query\Wishlist\WishlistMember\GetWishlistMemberQuery;
use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Response\WishlistMemberResponse;
use Domain\Wishlist\Service\GetClaimantWishlistMemberIdInterface;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class GetClaimantWishlistMemberId implements GetClaimantWishlistMemberIdInterface
{
    public function __construct(private Security $security, private QueryBusInterface $queryBus)
    {

    }

    public function get(): string
    {
        /** @var UserEntity $userEntity */
        $userEntity = $this->security->getUser();

        $query = new GetWishlistMemberQuery();
        $query->setRequest(new GetWishlistMemberRequest(null, $userEntity->getStringUuid()));

        /** @var WishlistMemberResponse $wishlistMemberResponse */
        $wishlistMemberResponse = $this->queryBus->ask($query);

        return $wishlistMemberResponse->getId();
    }
}
