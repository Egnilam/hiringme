<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

enum PriorityEnum: string
{
    case LOW = 'LOW';
    case MEDIUM = 'MEDIUM';
    case HIGH = 'HIGH';
}
