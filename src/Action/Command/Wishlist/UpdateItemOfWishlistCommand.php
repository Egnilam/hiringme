<?php

declare(strict_types=1);

namespace App\Action\Command\Wishlist;

use App\Infrastructure\Framework\Messenger\Command\CommandInterface;

final class UpdateItemOfWishlistCommand extends AbstractWishlistItemCommand implements CommandInterface
{
    private string $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }
}
