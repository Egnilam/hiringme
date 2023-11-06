<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistMember;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\ValueObject\EmailValueObject;
use Domain\Wishlist\Domain\Model\WishlistMember;
use Domain\Wishlist\Port\Command\WishlistMember\UpdateWishlistMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistMemberCommandRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistMember\UpdateWishlistMemberRequest;

final readonly class UpdateWishlistMemberUseCase implements UpdateWishlistMemberInterface
{
    public function __construct(
        private WishlistMemberCommandRepositoryInterface $wishlistMemberCommandRepository
    ) {
    }
    /**
     * @throws EmailFormatException
     * @throws DomainException
     */
    public function execute(UpdateWishlistMemberRequest $request): string
    {
        $wishlistMember = new WishlistMember(
            $request->getId(),
            new EmailValueObject($request->getEmail()),
            $request->getUserId(),
            $request->isRegistered()
        );

        return $this->wishlistMemberCommandRepository->update($wishlistMember);
    }
}
