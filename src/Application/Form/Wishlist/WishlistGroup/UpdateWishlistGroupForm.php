<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistGroup;

use App\Action\Command\Wishlist\WishlistGroup\UpdateWishlistGroupCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

final class UpdateWishlistGroupForm extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translator->trans('form.name')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdateWishlistGroupCommand::class,
        ]);
    }
}
