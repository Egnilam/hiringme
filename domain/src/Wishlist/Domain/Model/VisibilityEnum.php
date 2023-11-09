<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\Model;

enum VisibilityEnum: string
{
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
    case RESTRICT = 'RESTRICT';
}
