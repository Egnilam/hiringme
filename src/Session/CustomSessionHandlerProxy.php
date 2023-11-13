<?php

declare(strict_types=1);

namespace App\Session;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;

class CustomSessionHandlerProxy extends SessionHandlerProxy
{
    public function __construct(\SessionHandlerInterface $handler, private Security $security)
    {

        parent::__construct($handler);
    }

    public function write(string $sessionId,string $data): bool
    {
        return parent::write($sessionId, $data);
    }
}