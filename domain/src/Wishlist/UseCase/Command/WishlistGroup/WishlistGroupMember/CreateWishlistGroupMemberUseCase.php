<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember;

use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberInterface;
use Domain\Wishlist\Port\Command\WishlistMember\RegisterWishlistMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\RegisterWishlistMemberRequest;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;
use Domain\Wishlist\Request\WishlistMember\GetWishlistMemberRequest;

final readonly class CreateWishlistGroupMemberUseCase implements CreateWishlistGroupMemberInterface
{
    public function __construct(
        private IdServiceInterface $idService,
        private WishlistGroupMemberCommandRepositoryInterface $wishlistGroupMemberCommandRepository,
        private WishlistMemberQueryRepositoryInterface $wishlistMemberQueryRepository,
        private RegisterWishlistMemberInterface $registerWishlistMember
    ) {

    }

    public function execute(CreateWishlistGroupMemberRequest $request): string
    {
        $wishlistGroupMember = new WishlistGroupMember(
            $this->idService->next(),
            $request->getPseudonym(),
            $this->getWishlistMemberId($request),
            $request->getWishlistGroupId()
        );

        return $this->wishlistGroupMemberCommandRepository->create($wishlistGroupMember);
    }

    private function getWishlistMemberId(CreateWishlistGroupMemberRequest $request): string
    {
        if($request->getEmail()) {
            $wishlistMemberRequest = new GetWishlistMemberRequest(null, $request->getEmail());

            try {
                $wishlistMember = $this->wishlistMemberQueryRepository->get($wishlistMemberRequest);

                return $wishlistMember->getId();
            } catch (NotFoundException $exception) {

            }
        }

        return $this->registerWishlistMember($request->getEmail());
    }

    private function registerWishlistMember(?string $email): string
    {
        $registerWishlistMemberRequest = new RegisterWishlistMemberRequest($email, false);

        return $this->registerWishlistMember->execute($registerWishlistMemberRequest);
    }
}
