<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist;

use App\Action\Command\Wishlist\CreateWishlistCommand;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CreateWishlistForm extends AbstractWishlistForm
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CreateWishlistCommand::class,
        ]);
    }
}
