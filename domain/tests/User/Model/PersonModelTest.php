<?php

declare(strict_types=1);

namespace Domain\Tests\User\Model;

use Domain\Common\Domain\Exception\DomainException;
use Domain\Common\Domain\Exception\NameFormatException;
use Domain\Common\Domain\ValueObject\Name;
use Domain\User\Domain\Model\Person;
use PHPUnit\Framework\TestCase;

class PersonModelTest extends TestCase
{
    public function testValidPerson(): void
    {
        $person = new Person(
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
        $this->assertSame('FLORIAN', $person->getFirstName());
        $this->assertSame('MALINGE', $person->getLastName());
    }

    public function testValidPersonWithAccent(): void
    {
        $person = new Person(
            new Name('floriané', Name::PROPERTY_FIRSTNAME),
            new Name('malingeé', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
        $this->assertSame('FLORIANÉ', $person->getFirstName());
        $this->assertSame('MALINGEÉ', $person->getLastName());
    }

    public function testValidPersonWithDash(): void
    {
        $person = new Person(
            new Name('flo-rian', Name::PROPERTY_FIRSTNAME),
            new Name('mal-inge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
        $this->assertSame('FLO-RIAN', $person->getFirstName());
        $this->assertSame('MAL-INGE', $person->getLastName());
    }

    public function testExceptionInvalidFirstNameWithLengthToShort(): void
    {
        $this->expectException(NameFormatException::class);
        $person = new Person(
            new Name('fl', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidFirstNameWithLengthToLong(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new Name(str_repeat('florian', 15), Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidFirstNameWithSpecialChars(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new Name('flo_rian', Name::PROPERTY_FIRSTNAME),
            new Name('malinge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidLastNameWithLengthToShort(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('ma', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidLastNameWithLengthToLong(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name(str_repeat('malinge', 15), Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidLastNameWithSpecialChars(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('mal_inge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionBirthDateToOld(): void
    {
        $this->expectException(DomainException::class);
        new Person(
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('mal_inge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1900-08-01')
        );
    }

    public function testExceptionBirthDateToYoung(): void
    {
        $this->expectException(DomainException::class);
        new Person(
            new Name('florian', Name::PROPERTY_FIRSTNAME),
            new Name('mal_inge', Name::PROPERTY_LASTNAME),
            new \DateTimeImmutable()
        );
    }
}
