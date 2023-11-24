<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistBasketItem;

use App\Action\Command\Wishlist\WishlistBasketItem\AddMemberToWishlistBasketItemCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

final class AddMemberToWishlistBasketItemForm extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('visible', CheckboxType::class, [
                'required' => false,
                'label' => $this->translator->trans('form.name_visible')
            ])
            ->add('lock', CheckboxType::class, [
                'required' => false,
                'label' => $this->translator->trans('form.lock'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddMemberToWishlistBasketItemCommand::class,
        ]);
    }
}
