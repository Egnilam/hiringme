<?php

declare(strict_types=1);

namespace App\Application\Form\AnonymousUser;

use App\Action\Command\AnonymousUser\LoginWishlistMemberCommand;
use Domain\Wishlist\Response\WishlistGroupMemberResponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginWishlistMemberForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('wishlistMemberId', ChoiceType::class, [
                'label' => 'Members',
                'choices' => $options['members'],
                'choice_value' => 'wishlistMemberId',
                'choice_label' => 'pseudonym',
                'expanded' => true
            ])
            ->get('wishlistMemberId')->addModelTransformer(new CallbackTransformer(
                function () {},
                function (WishlistGroupMemberResponse $wishlistGroupMemberResponse) {
                    return $wishlistGroupMemberResponse->getWishlistMemberId();
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LoginWishlistMemberCommand::class,
            'members' => []
        ]);
    }
}
