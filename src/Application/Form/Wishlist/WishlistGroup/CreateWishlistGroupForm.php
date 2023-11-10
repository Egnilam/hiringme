<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\AddMemberToWishlistGroupCommand;
use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CreateWishlistGroupForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('ownerPseudonym', TextType::class)
            ->add('members', CollectionType::class, [
                'entry_type' => AddWishlistGroupMemberForm::class,
                'entry_options' => ['label' => false, 'pseudonym_mandatory' => false],
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->addEventListener(FormEvents::POST_SET_DATA, function (FormEvent $event): void {
                $event->getForm()->get('members')->setData([new AddMemberToWishlistGroupCommand()]);
            })
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event): void {
                /** @var CreateWishlistGroupCommand $createWishlistGroupCommand */
                $createWishlistGroupCommand = $event->getData();

                $reflectionClass = new \ReflectionClass(AddMemberToWishlistGroupCommand::class);
                foreach ($createWishlistGroupCommand->getMembers() as $index => $member) {
                    if(!$reflectionClass->getProperty('pseudonym')->isInitialized($member)) {
                        $createWishlistGroupCommand->removeMember($index);
                    }
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateWishlistGroupCommand::class,
        ]);
    }
}
