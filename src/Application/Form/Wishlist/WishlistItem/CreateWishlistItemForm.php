<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\AddItemToWishlistCommand;
use Domain\Wishlist\Domain\Model\PriorityEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateWishlistItemForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class)
            ->add('link', TextType::class, [
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('priority', EnumType::class, [
                'class' => PriorityEnum::class,
                'placeholder' => 'Choose an option',
                'required' => false,
            ])
            ->add('price', NumberType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddItemToWishlistCommand::class,
        ]);
    }
}
