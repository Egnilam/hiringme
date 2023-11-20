<?php

declare(strict_types=1);

namespace App\Application\View;

use Symfony\Component\Translation\TranslatableMessage;

class NavbarView implements ViewInterface
{
    private string $activeProperty;

    /** @var array<TranslatableMessage>  */
    private array $wishlists = [];

    /** @var array<TranslatableMessage>  */
    private array $groups = [];

    /** @var array<TranslatableMessage>  */
    private array $basket = [];

    /** @var array<TranslatableMessage>  */
    private array $logout = [];

    public function __construct(string $activeProperty = 'wishlists')
    {
        $this->activeProperty = $activeProperty;
        $this->wishlists['message'] = new TranslatableMessage('ui.navbar.wishlists');
        $this->groups['message'] = new TranslatableMessage('ui.navbar.groups');
        $this->basket['message'] = new TranslatableMessage('ui.navbar.basket');
        $this->logout['message'] = new TranslatableMessage('ui.navbar.logout');
    }

    public function getActiveProperty(): string
    {
        return $this->activeProperty;
    }

    public function getWishlists(): TranslatableMessage
    {
        return $this->wishlists['message'];
    }

    public function getGroups(): TranslatableMessage
    {
        return $this->groups['message'];
    }

    public function getBasket(): TranslatableMessage
    {
        return $this->basket['message'];
    }

    public function getLogout(): TranslatableMessage
    {
        return $this->logout['message'];
    }
}
