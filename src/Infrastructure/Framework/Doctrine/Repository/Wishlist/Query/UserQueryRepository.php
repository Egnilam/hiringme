<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Wishlist\Repository\Query\UserQueryRepositoryInterface;

final class UserQueryRepository extends AbstractRepository implements UserQueryRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function searchUserIdByEmail(string $email): string
    {
        $userEntity = $this->entityManager->getRepository(UserEntity::class)->findOneBy(['email' => $email]);
        if($userEntity === null) {
            throw new NotFoundException();
        }

        return $userEntity->getStringUuid();
    }
}
