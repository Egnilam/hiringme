<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist;

use App\Action\Command\Wishlist\DeleteWishlistCommand;
use App\Application\Http\CustomAbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlists')]
final class DeleteWishlistController extends CustomAbstractController
{
    public const NAME = 'wishlist_delete';

    /**
     * @return array<string>
     */
    public static function getRequestParams(string $id): array
    {
        return ['id' => $id];
    }

    #[Route('/{id}', name: self::NAME, methods: ['DELETE'])]
    public function __invoke(Request $request, string $id): Response
    {
        if($this->isCsrfTokenValid(sprintf('delete.%s', $id), (string)$request->request->get('_token'))) {
            try {
                $command = new DeleteWishlistCommand();
                $command
                    ->setId($id);

                $this->commandBus->dispatch($command);
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }

        return $this->redirectToRoute('wishlist_list');
    }
}
