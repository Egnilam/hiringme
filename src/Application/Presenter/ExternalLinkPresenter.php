<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Application\View\ExternalLinkView;

class ExternalLinkPresenter
{
    public function present(
        string $text,
        string $url,
        string $target = '_blank'
    ): ExternalLinkView {
        return new ExternalLinkView(
            $text,
            $url,
            $target
        );
    }
}
