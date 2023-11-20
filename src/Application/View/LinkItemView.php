<?php

declare(strict_types=1);

namespace App\Application\View;

use Symfony\Component\Translation\TranslatableMessage;

class LinkItemView
{
    private TranslatableMessage $message;

    public function __construct(
        string $message,
        private readonly string $link
    ) {
        $this->message = new TranslatableMessage($message);
    }

    public function getMessage(): TranslatableMessage
    {
        return $this->message;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}
