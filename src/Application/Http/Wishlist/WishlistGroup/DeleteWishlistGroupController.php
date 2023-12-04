<?php

declare(strict_types=1);

namespace App\Application\Http\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\DeleteWishlistGroupCommand;
use App\Application\Http\CustomAbstractController;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('wishlist_groups')]
final class DeleteWishlistGroupController extends CustomAbstractController
{
    public const NAME = 'wishlist_group_delete';

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
                $command = new DeleteWishlistGroupCommand();
                $command
                    ->setId($id);

                $this->commandBus->dispatch($command);
            } catch (\Exception $exception) {
                $this->exceptionService->execute($exception);
            }
        }
        return $this->redirectToRoute('wishlist_group_list');
    }
}
