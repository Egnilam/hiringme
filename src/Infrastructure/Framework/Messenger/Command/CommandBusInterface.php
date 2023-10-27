<?php

declare(strict_types=1);

namespace App\Infrastructure\Framework\Messenger\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
