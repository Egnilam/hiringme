<?php

declare(strict_types=1);

namespace Domain\Wishlist\Domain\ValueObject;

use Domain\Common\Domain\Exception\DomainException;

/**
 * Pattern resource : https://daringfireball.net/2010/07/improved_regex_for_matching_urls
 */
final class LinkItem
{
    private const LINK_PATTERN = "#(?i)\b((?:https?://|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))#";
    private string $link;

    /**
     * @throws DomainException
     */
    public function __construct(string $link)
    {
        if(!preg_match(self::LINK_PATTERN, $link)) {
            throw new DomainException('Invalid URL');
        }
        $this->link = $link;
    }

    public function get(): string
    {
        return $this->link;
    }
}
