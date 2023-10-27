<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine;

use App\Infrastructure\Framework\Doctrine\Entity\EntityInterface;

final class StorePersistEntityService
{
    /**
     * @var array<EntityInterface>
     */
    private array $entities = [];

    public function add(string $uuid, EntityInterface $entity): void
    {
        $this->entities[$uuid] = $entity;
    }

    public function remove(string $uuid): void
    {
        unset($this->entities[$uuid]);
    }

    public function has(string $uuid): bool
    {
        return isset($this->entities[$uuid]);
    }

    public function search(string $uuid): EntityInterface
    {
        return $this->entities[$uuid];
    }

    public function clean(): void
    {
        $this->entities = [];
    }
}
