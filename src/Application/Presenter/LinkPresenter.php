<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Application\View\LinkView;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use function Symfony\Component\String\s;

class LinkPresenter
{
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private TranslatorInterface $translator
    ) {

    }

    /**
     * @param array<string, string> $urlParams
     */
    public function present(
        string $text,
        string $url,
        array $urlParams = [],
    ): LinkView {
        return new LinkView(
            $this->translator->trans($text),
            $this->urlGenerator->generate($url, $urlParams),
        );
    }
}
