<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\ValueObject;

use Domain\Common\Domain\Exception\DomainException;

class PriceItem
{
    private const MIN_PRICE = 0;
    private const MAX_PRICE = 1000000000;

    private float $price;

    /**
     * @throws DomainException
     */
    public function __construct(float $price)
    {
        if($price <= self::MIN_PRICE) {
            throw new DomainException(sprintf('Should be > %d', self::MIN_PRICE));
        }

        if($price >= self::MAX_PRICE) {
            throw new DomainException(sprintf('Should be < %d', self::MAX_PRICE));
        }

        $this->price = round($price, 2);
    }

    public function get(): float
    {
        return $this->price;
    }
}
