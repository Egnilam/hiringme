<?php

declare(strict_types=1);

namespace App\Application\View;

readonly class DeleteFormView
{
    public function __construct(
        private string $action,
        private string $tokenId
    ) {
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getTokenId(): string
    {
        return $this->tokenId;
    }
}
