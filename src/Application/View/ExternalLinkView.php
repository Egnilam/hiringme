<?php

declare(strict_types=1);

namespace App\Application\View;

readonly class ExternalLinkView extends LinkView
{
    public function __construct(
        private string $text,
        private string $link,
        private string $target = '_blank',
    ) {
        parent::__construct($this->text, $this->link);
    }

    public function getTarget(): string
    {
        return $this->target;
    }
}
