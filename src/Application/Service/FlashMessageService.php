<?php

declare(strict_types=1);

namespace App\Application\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

final readonly class FlashMessageService
{
    public const TYPE_ERROR = 'error';
    public const TYPE_SUCCESS = 'success';
    public const TYPE_NOTICE = 'notice';
    public const TYPE_WARNING = 'warning';

    public function __construct(private RequestStack $requestStack)
    {
    }

    /**
     * @throws \Exception
     */
    public function add(string $type, string $message): void
    {
        if (!$this->requestStack->getSession() instanceof FlashBagAwareSessionInterface) {
            throw new \Exception();
        }

        $this->requestStack->getSession()->getFlashBag()->add($type, $message);

    }
}
