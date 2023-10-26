<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup\WishlistGroupMember;

use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Common\Domain\ValueObject\EmailValueObject;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistGroupMember;
use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberInterface;
use Domain\Wishlist\Port\Command\WishlistMember\RegisterWishlistMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupMemberCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberRequest;
use Domain\Wishlist\Request\WishlistMember\GetWishlistMemberRequest;
use Domain\Wishlist\Request\WishlistMember\RegisterWishlistMemberRequest;

final readonly class CreateWishlistGroupMemberUseCase implements CreateWishlistGroupMemberInterface
{
    public function __construct(
        private IdServiceInterface $idService,
        private WishlistGroupMemberCommandRepositoryInterface $wishlistGroupMemberCommandRepository,
        private WishlistMemberQueryRepositoryInterface $wishlistMemberQueryRepository,
        private RegisterWishlistMemberInterface $registerWishlistMember
    ) {

    }

    /**
     * @throws EmailFormatException
     */
    public function execute(CreateWishlistGroupMemberRequest $request): string
    {
        $wishlistGroupMember = new WishlistGroupMember(
            $this->idService->next(),
            $request->getPseudonym(),
            $this->getWishlistMemberId($request),
            $request->getWishlistGroupId(),
            $request->isOwner()
        );

        return $this->wishlistGroupMemberCommandRepository->create($wishlistGroupMember);
    }

    /**
     * @throws EmailFormatException
     */
    private function getWishlistMemberId(CreateWishlistGroupMemberRequest $request): string
    {
        if($request->getEmail()) {
            $email = new EmailValueObject($request->getEmail());
            $wishlistMemberRequest = new GetWishlistMemberRequest(null, $email->get());

            try {
                $wishlistMemberResponse = $this->wishlistMemberQueryRepository->get($wishlistMemberRequest);

                return $wishlistMemberResponse->getId();
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
