<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Uuid;

use Domain\Common\Service\IdServiceInterface;
use Symfony\Component\Uid\Uuid;

class IdService implements IdServiceInterface
{
    public static function generate(): Uuid
    {
        return Uuid::v4();
    }

    public function next(): string
    {
        return self::toString(self::generate());
    }

    public static function fromString(string $uuid): Uuid
    {
        return Uuid::fromRfc4122($uuid);
    }

    public static function toString(Uuid $uuid): string
    {
        return $uuid->toRfc4122();
    }

    public static function toBinary(Uuid $uuid): string
    {
        return $uuid->toBinary();
    }

    public static function fromStringToBinary(string $uuid): string
    {
        return Uuid::fromRfc4122($uuid)->toBinary();
    }
}
