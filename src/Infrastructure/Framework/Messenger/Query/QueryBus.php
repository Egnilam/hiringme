<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Messenger\Query;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class QueryBus implements QueryBusInterface
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function ask(QueryInterface $query): mixed
    {
        return $this->handleQuery($query);
    }
}
