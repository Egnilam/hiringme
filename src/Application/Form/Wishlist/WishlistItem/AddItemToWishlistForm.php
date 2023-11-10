<?php

declare(strict_types=1);

namespace App\Application\Form\Wishlist\WishlistItem;

use App\Action\Command\Wishlist\AddItemToWishlistCommand;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddItemToWishlistForm extends AbstractWishlistItemForm
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AddItemToWishlistCommand::class,
        ]);
    }
}
