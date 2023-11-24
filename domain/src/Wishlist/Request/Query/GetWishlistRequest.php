<?php

declare(strict_types=1);

namespace Domain\Wishlist\Request\Query;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\NotFoundException;
use Domain\Common\Request\OptionsRequestTrait;

final class GetWishlistRequest
{
    use OptionsRequestTrait;

    public const OPT_LOAD_ITEMS = 'opt.load.items';

    public const OPT_GROUP = 'opt.group';

    public const OPT_ITEMS_LOAD_BASKET_ITEMS = 'opt.items.load.basket.items';


    /**
     * @param array<string, mixed> $options
     * @throws DomainException
     */
    public function __construct(
        private readonly string $id,
        array $options = [],
    ) {
        foreach ($options as $option => $value) {
            if(
                $option === self::OPT_LOAD_ITEMS
                && is_bool($value) === false
            ) {
                throw new DomainException('Not acceptable');
            }

            if(
                $option === self::OPT_ITEMS_LOAD_BASKET_ITEMS
                && is_bool($value) === false
            ) {
                throw new DomainException('Not acceptable');
            }

            $this->addOption($option, $value);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    private function checkOptionExist(string $option): void
    {
        $options = [
            self::OPT_LOAD_ITEMS,
            self::OPT_GROUP,
            self::OPT_ITEMS_LOAD_BASKET_ITEMS,
        ];

        if(!in_array($option, $options)) {
            throw new NotFoundException();
        }
    }
}
