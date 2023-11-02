<?php

declare(strict_types=1);

namespace App\Application\Components\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberCommand;
use App\Application\Form\Wishlist\WishlistGroup\CreateWishlistGroupForm;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class WishlistGroupFormComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    /**
     * The initial data used to create the form.
     */
    #[LiveProp]
    public ?CreateWishlistGroupCommand $initialFormData = null;

    public ?string $error = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CreateWishlistGroupForm::class, $this->initialFormData);
    }

    #[LiveAction]
    public function addWishlistGroupMember(): void
    {
        $this->formValues['members'][] = new AddWishlistGroupMemberCommand();
    }

    #[LiveAction]
    public function removeWishlistGroupMember(#[LiveArg] int $index): void
    {
        unset($this->formValues['members'][$index]);
    }

    /**
     * @throws \Exception
     */
    #[LiveAction]
    public function save(CommandBusInterface $commandBus): ?Response
    {
        try {
            $this->submitForm();

            /** @var CreateWishlistGroupCommand $command */
            $command = $this->getForm()->getData();

            $user = $this->getUser();
            if($user === null) {
                throw new \Exception('No user found', 500);
            }
            $command->setOwnerEmail($user->getUserIdentifier());

            $commandBus->dispatch($command);

            return $this->redirectToRoute('wishlist_group_list');
        } catch (\Exception $exception) {
            $this->error = $exception->getMessage();
            return null;
        }
    }
}
