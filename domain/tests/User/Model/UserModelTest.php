<?php

declare(strict_types=1);

namespace Domain\Tests\User\Model;

use Domain\Common\Domain\Exception\EmailFormatException;
use Domain\Common\Domain\ValueObject\Email;
use Domain\Common\Domain\ValueObject\Name;
use Domain\User\Domain\Enum\UserRoleEnum;
use Domain\User\Domain\Exception\UserRoleException;
use Domain\User\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    public function testValidUser(): void
    {
        $user = new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('test@test.fr'),
            'password',
            [UserRoleEnum::USER->value],
        );

        $this->assertSame('test@test.fr', $user->getEmail());
    }

    public function testEmailExceptionWithoutAt(): void
    {
        $this->expectException(EmailFormatException::class);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('testtest.fr'),
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithoutDot(): void
    {
        $this->expectException(EmailFormatException::class);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('test@testfr'),
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithInvalidCharsAtFirstPart(): void
    {
        $this->expectException(EmailFormatException::class);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('teést@test.fr'),
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithInvalidCharsAtSecondPart(): void
    {
        $this->expectException(EmailFormatException::class);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('test@teést.fr'),
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithInvalidCharsAtThirdPart(): void
    {
        $this->expectException(EmailFormatException::class);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('test@test.fé'),
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testRoleExceptionInvalidProperty(): void
    {
        $this->expectException(UserRoleException::class);
        $this->expectExceptionMessage(UserRoleException::INVALID_ROLE_NAME);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('test@test.fr'),
            'password',
            ['invalid role'],
        );
    }

    public function testRoleExceptionNoRoles(): void
    {
        $this->expectException(UserRoleException::class);
        $this->expectExceptionMessage(UserRoleException::AT_LEAST_ONE_ROLE);
        new User(
            '1',
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new Email('test@test.fr'),
            'password',
            [],
        );
    }
}
