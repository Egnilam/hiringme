<?php

declare(strict_types=1);

namespace App\Application\View;

readonly class LinkView
{
    public function __construct(
        private string $text,
        private string $link,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getLink(): string
    {
        return $this->link;
    }
}
