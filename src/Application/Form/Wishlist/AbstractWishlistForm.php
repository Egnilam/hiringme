<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist;

use Domain\Wishlist\Domain\Model\VisibilityEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractWishlistForm extends AbstractType
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => $this->translator->trans('form.name')
            ])
            ->add('visibility', EnumType::class, [
                'class' => VisibilityEnum::class,
                'expanded' => true,
                'multiple' => false,
                'label' => $this->translator->trans('wishlist.visibility.label'),
                'choice_label' => function (VisibilityEnum $enum): string {
                    return $this->translator->trans(sprintf('wishlist.visibility.ENUM.%s', $enum->value));
                }
            ])
        ;
    }


}
