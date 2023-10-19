<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Repository\Wishlist\Query;

use App\Infrastructure\Framework\Doctrine\Entity\UserEntity;
use App\Infrastructure\Framework\Doctrine\Repository\AbstractRepository;
use Domain\Wishlist\Repository\Query\UserQueryRepositoryInterface;

final class UserQueryRepository extends AbstractRepository implements UserQueryRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function searchUserIdByEmail(string $email): string
    {
        $userEntity = $this->entityManager->getRepository(UserEntity::class)->findOneBy(['email' => $email]);
        if($userEntity === null) {
            throw new \Exception('Not found', 404);
        }

        return $userEntity->getStringUuid();
    }
}
