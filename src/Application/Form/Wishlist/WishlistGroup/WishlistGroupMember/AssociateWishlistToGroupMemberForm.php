<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\AssociateGroupMemberToWishlistCommand;
use Domain\Wishlist\Response\WishlistResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AssociateWishlistToGroupMemberForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('wishlistId', ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'label' => 'Wishlists',
                'choices' => $options['wishlists'],
                'choice_value' => 'id',
                'choice_label' => 'name',
            ])
            ->get('wishlistId')->addModelTransformer(new CallbackTransformer(
                function () {},
                function (WishlistResponse $wishlistResponse) {
                    return $wishlistResponse->getId();
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AssociateGroupMemberToWishlistCommand::class,
            'wishlists' => []
        ]);
    }
}
