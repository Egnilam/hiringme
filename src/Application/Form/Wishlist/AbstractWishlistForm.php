<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist;

use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractWishlistForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
            ])
            ->add('visibility', EnumType::class, [
                'class' => VisibilityEnum::class,
                'expanded' => true,
                'multiple' => false,
                'label' => 'Visibility',
            ])
        ;
    }


}
