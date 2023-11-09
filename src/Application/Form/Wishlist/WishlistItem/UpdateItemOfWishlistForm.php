<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\UpdateItemOfWishlistCommand;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class UpdateItemOfWishlistForm extends WishlistItemForm
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UpdateItemOfWishlistCommand::class,
        ]);
    }
}
