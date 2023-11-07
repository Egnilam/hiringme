<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistMember;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Common\Domain\ValueObject\Email;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Port\Command\WishlistMember\RegisterWishlistMemberInterface;
use Domain\Wishlist\Port\Command\WishlistMember\UpdateWishlistMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistMemberCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\UserQueryRepositoryInterface;
use Domain\Wishlist\Repository\Query\WishlistMemberQueryRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistMember\RegisterWishlistMemberRequest;
use Domain\Wishlist\Request\Command\WishlistMember\UpdateWishlistMemberRequest;
use Domain\Wishlist\Request\Query\WishlistMember\GetWishlistMemberRequest;

final readonly class RegisterWishlistMemberUseCase implements RegisterWishlistMemberInterface
{
    public function __construct(
        private WishlistMemberCommandRepositoryInterface $wishlistMemberCommandRepository,
        private WishlistMemberQueryRepositoryInterface $wishlistMemberQueryRepository,
        private UpdateWishlistMemberInterface $updateWishlistMember,
        private UserQueryRepositoryInterface $userQueryRepository,
        private IdServiceInterface $idService,
    ) {
    }

    /**
     * @throws EmailFormatException
     * @throws DomainException
     */
    public function execute(RegisterWishlistMemberRequest $request): string
    {
        if($request->getEmail()) {
            $email = new Email($request->getEmail());

            $userId = $request->isRegistered() ?
                $this->userQueryRepository->searchUserIdByEmail($email->get()) : null;

            $updateResult = $this->updateWishlistMemberIfExist($email->get(), $userId, $request->isRegistered());
            if($updateResult) {
                return $updateResult;
            }
        }

        $wishListMember = new WishlistMember(
            $this->idService->next(),
            $email ?? null,
            $userId ?? null,
            $request->isRegistered()
        );

        return $this->wishlistMemberCommandRepository->register($wishListMember);
    }

    private function updateWishlistMemberIfExist(string $email, ?string $userId, bool $registered): ?string
    {
        try {
            $getWishlistMemberRequest = new GetWishlistMemberRequest(null, $email);
            $wishlistMemberResponse = $this->wishlistMemberQueryRepository->get($getWishlistMemberRequest);
        } catch (NotFoundException $exception) {
            return null;
        }

        $updateWishlistMemberRequest = new UpdateWishlistMemberRequest(
            $wishlistMemberResponse->getId(),
            $email,
            $userId,
            $registered
        );

        return $this->updateWishlistMember->execute($updateWishlistMemberRequest);
    }
}
