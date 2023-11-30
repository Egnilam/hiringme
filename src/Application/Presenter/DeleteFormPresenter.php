<?php

declare(strict_types=1);

namespace App\Application\Presenter;

use App\Application\View\DeleteFormView;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DeleteFormPresenter
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {

    }

    /**
     * @param array<string, string> $urlParams
     */
    public function present(string $id, string $actionUrl, array $urlParams = []): DeleteFormView
    {
        return new DeleteFormView(
            $this->urlGenerator->generate($actionUrl, $urlParams),
            sprintf('delete.%s', $id)
        );
    }
}
