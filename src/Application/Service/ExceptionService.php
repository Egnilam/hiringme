<?php

declare(strict_types=1);

namespace App\Application\Service;

use Domain\Common\Domain\Exception\DomainException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final readonly class ExceptionService
{
    public function __construct(private FlashMessageService $flashMessageService)
    {
    }

    public function execute(\Exception $exception): void
    {
        if($exception instanceof HandlerFailedException) {
            foreach ($exception->getNestedExceptions() as $nestedException) {
                if(is_subclass_of($nestedException, DomainException::class)) {
                    $this->fromDomainException($nestedException);
                }
            }
        }
    }

    private function fromDomainException(DomainException $exception): void
    {
        $this->flashMessageService->add(FlashMessageService::TYPE_ERROR, $exception->getMessage());
    }
}
