<?php

declare(strict_types=1);

namespace Domain\Common\Service;

interface IdServiceInterface
{
    public function next(): string;
}
