<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember;

use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Common\Domain\ValueObject\Email;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Domain\ValueObject\WishlistMemberId;
use Domain\Wishlist\Port\Command\WishlistMember\RegisterWishlistMemberInterface;
use Domain\Wishlist\Repository\Query\WishlistMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\BuildWishlistGroupMemberRequest;
use Domain\Wishlist\Request\Command\WishlistMember\RegisterWishlistMemberRequest;

final readonly class BuildWishlistGroupMember
{
    public function __construct(
        private IdServiceInterface $idService,
        private RegisterWishlistMemberInterface $registerWishlistMember,
        private WishlistMemberQueryRepositoryInterface $wishlistMemberQueryRepository
    ) {

    }

    /**
     * @throws EmailFormatException
     */
    public function execute(BuildWishlistGroupMemberRequest $request): WishlistGroupMember
    {
        if($request->getEmail()) {
            $email = new Email($request->getEmail());
        }

        return new WishlistGroupMember(
            $this->idService->next(),
            $request->getPseudonym(),
            $email ?? null,
            $this->getWishlistMemberId($email ?? null),
            $request->getWishlistGroupId(),
            $request->isOwner()
        );
    }

    private function getWishlistMemberId(?Email $email): WishlistMemberId
    {
        if($email) {
            try {
                return $this->wishlistMemberQueryRepository->getIdByEmail($email->get());
            } catch (NotFoundException $exception) {

            }
        }

        return $this->createWishlistMember($email);
    }

    private function createWishlistMember(?Email $email): WishlistMemberId
    {
        $registerWishlistMemberRequest = new RegisterWishlistMemberRequest($email?->get(), false);

        return new WishlistMemberId($this->registerWishlistMember->execute($registerWishlistMemberRequest));
    }
}
