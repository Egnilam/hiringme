<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistItem;

use Domain\Wishlist\Domain\Model\PriorityEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractWishlistItemForm extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'label' => $this->translator->trans('form.name')
            ])
            ->add('link', TextType::class, [
                'label' => $this->translator->trans('form.link'),
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => $this->translator->trans('form.description'),
                'required' => false,
            ])
            ->add('priority', EnumType::class, [
                'class' => PriorityEnum::class,
                'label' => $this->translator->trans('wishlist.item.priority.label'),
                'placeholder' => 'Choose an option',
                'required' => false,
                'choice_label' => function (PriorityEnum $enum): string {
                    return $this->translator->trans(sprintf('wishlist.item.priority.ENUM.%s', $enum->value));
                }
            ])
            ->add('price', NumberType::class, [
                'required' => false,
                'label' => $this->translator->trans('wishlist.item.price.label')
            ])
            ->add('test', ChoiceType::class, [
                'mapped' => false,
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Fiat' => 0,
                    'Ferrari' => 1,
                    'Renault' => 2
                ]
            ])
        ;
    }
}
