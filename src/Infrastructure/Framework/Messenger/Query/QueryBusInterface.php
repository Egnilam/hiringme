<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Messenger\Query;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): mixed;
}
