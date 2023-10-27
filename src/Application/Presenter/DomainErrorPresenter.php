<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use Domain\Common\Domain\Exception\DomainException;

class DomainErrorPresenter
{
    /**
     * @var array<string> $messages
     */
    private array $messages;

    /**
     * @param array<DomainException> $domainExceptions
     */
    public function __construct(array $domainExceptions)
    {
        foreach ($domainExceptions as $domainException) {
            $this->messages[] = $domainException->getMessage();
        }
    }

    /**
     * @return array<string>
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
