<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\CreateWishlistGroupCommand;
use App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember\CreateWishlistGroupMemberForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateWishlistGroupForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('owner', HiddenType::class)
            ->add('name', TextType::class)
            ->add('members', CollectionType::class, [
                'entry_type' => CreateWishlistGroupMemberForm::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateWishlistGroupCommand::class,
        ]);
    }
}
