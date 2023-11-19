<?php

declare(strict_types=1);

namespace App\Application\Http;

use App\Application\Service\ExceptionService;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use App\Infrastructure\Framework\Messenger\Query\QueryBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class CustomAbstractController extends AbstractController
{
    public function __construct(
        protected CommandBusInterface $commandBus,
        protected QueryBusInterface $queryBus,
        protected ExceptionService $exceptionService
    ) {

    }
}
