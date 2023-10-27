<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\EventListener;

use App\Infrastructure\Framework\Doctrine\Entity\EntityInterface;
use App\Infrastructure\Framework\Doctrine\StorePersistEntityService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::prePersist)]
readonly class StorePersistEntityEventListener
{
    public function __construct(private StorePersistEntityService $storePersistEntityService)
    {
    }

    public function prePersist(PrePersistEventArgs $event): void
    {
        /** @var EntityInterface $entity */
        $entity = $event->getObject();

        $this->storePersistEntityService->add($entity->getStringUuid(), $entity);
    }
}
