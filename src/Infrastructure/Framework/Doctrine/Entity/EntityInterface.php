<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Doctrine\Entity;

interface EntityInterface
{
    public function getStringUuid(): string;
}
