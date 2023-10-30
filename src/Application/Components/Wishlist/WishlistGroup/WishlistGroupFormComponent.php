<?php

declare(strict_types=1);

namespace App\Application\Components\Wishlist\WishlistGroup;
use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberCommand;
use App\Application\Form\Wishlist\WishlistGroup\CreateWishlistGroupForm;
use App\Infrastructure\Framework\Messenger\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
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

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(CreateWishlistGroupForm::class, $this->initialFormData);
    }

    #[LiveAction]
    public function addWishlistGroupMember(): void {
        $this->formValues['members'][] = new CreateWishlistGroupMemberCommand();
    }

    #[LiveAction]
    public function removeWishlistGroupMember(#[LiveArg] int $index): void {
        unset($this->formValues['members'][$index]);
    }

    #[LiveAction]
    public function save(CommandBusInterface $commandBus): void
    {
        $this->submitForm();

        /** @var CreateWishlistGroupCommand $command */
        $command = $this->getForm()->getData();
        $command->setOwnerEmail($this->getUser()->getUserIdentifier());

        $commandBus->dispatch($command);
    }

}