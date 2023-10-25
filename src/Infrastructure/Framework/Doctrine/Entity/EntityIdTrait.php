<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

use App\Infrastructure\Framework\Uuid\IdService;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

trait EntityIdTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: 'integer', nullable: false)]
    private int $id;

    #[ORM\Column(type: 'uuid', unique: true, nullable: false)]
    private Uuid $uuid;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function getStringUuid(): string
    {
        return $this->uuid->toRfc4122();
    }

    public function setStringUuid(string $uuid): self
    {
        $this->uuid = Uuid::fromRfc4122($uuid);
        return $this;
    }

    /**
     * @throws \Exception
     */
    #[ORM\PrePersist]
    public function setUuidValue(): void
    {
        if(
            isset($this->uuid)
            && !Uuid::isValid($this->uuid->toRfc4122())
        ) {
            throw new \Exception('Uuid should be configured', 500);
        }

        if(!isset($this->uuid)) {
            $this->uuid = IdService::generate();
        }
    }
}
