<?php

declare(strict_types=1);

namespace Domain\Tests\Wishlist\Model;

use Domain\Common\Domain\ValueObject\EmailValueObject;
use Domain\Wishlist\Domain\Model\WishlistMember;
use PHPUnit\Framework\TestCase;

class WishlistMemberTest extends TestCase
{
    public function testValidWishlistMember(): void
    {
        $wishlistMember = new WishlistMember(
            'id',
            new EmailValueObject('test@test.fr'),
            'user-id',
            true
        );

        $this->assertSame('test@test.fr', $wishlistMember->getEmail());
    }

    public function testExceptionInvalidUser(): void
    {
        $this->expectException(\Exception::class);
        new WishlistMember(
            'id',
            new EmailValueObject('test@test.fr'),
            null,
            true
        );
    }
}
