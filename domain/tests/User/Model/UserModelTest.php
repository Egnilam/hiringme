<?php

declare(strict_types=1);

namespace Domain\Tests\User\Model;

use Domain\User\Domain\Enum\UserRoleEnum;
use Domain\User\Domain\Exception\EmailException;
use Domain\User\Domain\Exception\UserRoleException;
use Domain\User\Domain\Model\User;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    public function testValidUser(): void
    {
        $user = new User(
            '1',
            'florian',
            'malinge',
            'test@test.fr',
            'password',
            [UserRoleEnum::USER->value],
        );

        $this->assertSame($user->getEmail(), 'test@test.fr');
    }

    public function testEmailExceptionWithoutAt(): void
    {
        $this->expectException(EmailException::class);
        new User(
            '1',
            'florian',
            'malinge',
            'testtest.fr',
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithoutDot(): void
    {
        $this->expectException(EmailException::class);
        new User(
            '1',
            'florian',
            'malinge',
            'test@testfr',
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithInvalidCharsAtFirstPart(): void
    {
        $this->expectException(EmailException::class);
        new User(
            '1',
            'florian',
            'malinge',
            'tesét@test.fr',
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithInvalidCharsAtSecondPart(): void
    {
        $this->expectException(EmailException::class);
        new User(
            '1',
            'florian',
            'malinge',
            'test@teést.fr',
            'password',
            [UserRoleEnum::USER->value],
        );
    }

    public function testEmailExceptionWithInvalidCharsAtThirdPart(): void
    {
        $this->expectException(EmailException::class);
        new User(
            '1',
            'florian',
            'malinge',
            'test@test.fé',
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
            'florian',
            'malinge',
            'test@test.fr',
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
            'florian',
            'malinge',
            'test@test.fr',
            'password',
            [],
        );
    }
}
