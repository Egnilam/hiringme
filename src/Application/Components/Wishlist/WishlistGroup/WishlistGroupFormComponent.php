<?php

declare(strict_types=1);

namespace App\Application\Components\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\AddMemberToWishlistGroupCommand;
use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Application\Form\Wishlist\WishlistGroup\CreateWishlistGroupForm;
use App\Application\Http\CustomAbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class WishlistGroupFormComponent extends CustomAbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    /**
     * The initial data used to create the form.
     */
    #[LiveProp]
    public ?CreateWishlistGroupCommand $initialFormData = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CreateWishlistGroupForm::class, $this->initialFormData);
    }

    #[LiveAction]
    public function addWishlistGroupMember(): void
    {
        $this->formValues['members'][] = new AddMemberToWishlistGroupCommand();
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
    public function save(): ?Response
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

            $this->commandBus->dispatch($command);

            return $this->redirectToRoute('wishlist_group_list');
        } catch (\Exception $exception) {
            $this->exceptionService->execute($exception);
            return null;
        }
    }
}
