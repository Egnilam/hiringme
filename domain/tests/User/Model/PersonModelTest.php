<?php

declare(strict_types=1);

namespace Domain\Tests\User\Model;

use Domain\Common\Domain\Exception\NameFormatException;
use Domain\Common\Domain\ValueObject\NameValueObject;
use Domain\User\Domain\Model\Person;
use PHPUnit\Framework\TestCase;

class PersonModelTest extends TestCase
{
    public function testValidPerson(): void
    {
        $person = new Person(
            new NameValueObject('florian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('malinge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
        $this->assertSame($person->getFirstName(), 'FLORIAN');
        $this->assertSame($person->getLastName(), 'MALINGE');
    }

    public function testValidPersonWithAccent(): void
    {
        $person = new Person(
            new NameValueObject('floriané', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('malingeé', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
        $this->assertSame($person->getFirstName(), 'FLORIANÉ');
        $this->assertSame($person->getLastName(), 'MALINGEÉ');
    }

    public function testValidPersonWithDash(): void
    {
        $person = new Person(
            new NameValueObject('flo-rian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('mal-inge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
        $this->assertSame($person->getFirstName(), 'FLO-RIAN');
        $this->assertSame($person->getLastName(), 'MAL-INGE');
    }

    public function testExceptionInvalidFirstNameWithLengthToShort(): void
    {
        $this->expectException(NameFormatException::class);
        $person = new Person(
            new NameValueObject('fl', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('malinge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidFirstNameWithLengthToLong(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new NameValueObject(str_repeat('florian', 15), NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('malinge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidFirstNameWithSpecialChars(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new NameValueObject('flo_rian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('malinge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidLastNameWithLengthToShort(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new NameValueObject('florian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('ma', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidLastNameWithLengthToLong(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new NameValueObject('florian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject(str_repeat('malinge', 15), NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionInvalidLastNameWithSpecialChars(): void
    {
        $this->expectException(NameFormatException::class);
        new Person(
            new NameValueObject('florian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('mal_inge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1994-08-15')
        );
    }

    public function testExceptionBirthDateToOld(): void
    {
        $this->expectException(\Exception::class);
        new Person(
            new NameValueObject('florian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('mal_inge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable('1900-08-01')
        );
    }

    public function testExceptionBirthDateToYoung(): void
    {
        $this->expectException(\Exception::class);
        new Person(
            new NameValueObject('florian', NameValueObject::PROPERTY_FIRSTNAME),
            new NameValueObject('mal_inge', NameValueObject::PROPERTY_LASTNAME),
            new \DateTimeImmutable()
        );
    }
}
