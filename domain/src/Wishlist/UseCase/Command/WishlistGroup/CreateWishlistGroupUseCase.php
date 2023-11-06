<?php

declare(strict_types=1);

namespace Domain\Wishlist\UseCase\Command\WishlistGroup;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Service\IdServiceInterface;
use Domain\Wishlist\Domain\Model\WishlistGroup;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupId;
use Domain\Wishlist\Domain\ValueObject\WishlistGroupMembers;
use Domain\Wishlist\Port\Command\WishlistGroup\CreateWishlistGroupInterface;
use Domain\Wishlist\Port\Command\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberInterface;
use Domain\Wishlist\Repository\Command\WishlistGroupCommandRepositoryInterface;
use Domain\Wishlist\Request\Command\WishlistGroup\CreateWishlistGroupRequest;
use Domain\Wishlist\Request\Command\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberRequest;

final readonly class CreateWishlistGroupUseCase implements CreateWishlistGroupInterface
{
    public function __construct(
        private WishlistGroupCommandRepositoryInterface $wishlistGroupCommandRepository,
        private IdServiceInterface                      $idService,
        private AddWishlistGroupMemberInterface         $createWishlistGroupMember,
    ) {
    }

    /**
     * @throws DomainException
     */
    public function execute(CreateWishlistGroupRequest $request): string
    {
        /*
         * 1 - Create all group members
         * 2 -
         * */
        $members = new WishlistGroupMembers($request->getMembers());
        $wishlistGroup = new WishlistGroup(
            new WishlistGroupId($this->idService->next()),
            $request->getName(),
            $members
        );

        $id = $this->wishlistGroupCommandRepository->create($wishlistGroup);

        $this->addWishlistGroupMember($request, $wishlistGroup);

        return $id;
    }

    private function addWishlistGroupMember(CreateWishlistGroupRequest $request, WishlistGroup $wishlistGroup): void
    {
        foreach ($request->getMembers() as $groupMemberRequest) {
            $createWishlistGroupMemberRequest = new AddWishlistGroupMemberRequest(
                $wishlistGroup->getId()->getId(),
                $groupMemberRequest->getPseudonym(),
                $groupMemberRequest->getEmail(),
                $groupMemberRequest->isOwner()
            );

            $this->createWishlistGroupMember->execute($createWishlistGroupMemberRequest);
        }
    }
}
