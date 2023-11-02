<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistGroup\WishlistGroupMember;

use App\Action\Command\Wishlist\WishlistGroup\WishlistGroupMember\AddWishlistGroupMemberCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddWishlistGroupMemberForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudonym', TextType::class, [
                'required' => $options['pseudonym_mandatory'],
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event): void {
                /** @var AddWishlistGroupMemberCommand $data */
                $data = $event->getData();

                $reflectionClass = new \ReflectionClass(AddWishlistGroupMemberCommand::class);
                if(
                    $data->getEmail()
                    && !$reflectionClass->getProperty('pseudonym')->isInitialized($data)
                ) {
                    $event->getForm()->get('pseudonym')->addError(new FormError('Pseudonym is required'));
                }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddWishlistGroupMemberCommand::class,
            'pseudonym_mandatory' => true
        ]);
    }
}
