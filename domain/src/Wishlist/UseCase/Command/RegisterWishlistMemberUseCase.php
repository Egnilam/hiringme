<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command;

use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\ValueObject\EmailValueObject;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Port\Command\RegisterWishlistMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistMemberCommandRepositoryInterface;
use Domain\Wishlist\Repository\Query\UserQueryRepositoryInterface;
use Domain\Wishlist\Request\RegisterWishlistMemberRequest;

final readonly class RegisterWishlistMemberUseCase implements RegisterWishlistMemberInterface
{
    public function __construct(
        private WishlistMemberCommandRepositoryInterface $wishlistMemberCommandRepository,
        private UserQueryRepositoryInterface $userQueryRepository,
        private IdServiceInterface $idService,
    ) {
    }

    /**
     * @throws EmailFormatException
     * @throws \Exception
     */
    public function execute(RegisterWishlistMemberRequest $request): void
    {
        if($request->getEmail()) {
            $email = new EmailValueObject($request->getEmail());

            $userId = $request->isRegistered() ?
                $this->userQueryRepository->searchUserIdByEmail($email->get()) : null;
        }

        //TODO: implement update case if email already exist in WishlistMember

        $wishListMember = new WishlistMember(
            $this->idService->next(),
            $email ?? null,
            $userId ?? null,
            $request->isRegistered()
        );

        $this->wishlistMemberCommandRepository->register($wishListMember);
    }
}
