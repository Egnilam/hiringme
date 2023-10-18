<?php

declare(strict_types=1);

namespace Domain\Tests\User\Model;

use Domain\User\Domain\Model\Person;
use PHPUnit\Framework\TestCase;

class PersonModelTest extends TestCase
{
    public function testValidPerson(): void
    {
        $person = new Person('florian', 'malinge', new \DateTimeImmutable('1994-08-15'));
        $this->assertSame($person->getFirstName(), 'FLORIAN');
        $this->assertSame($person->getLastName(), 'MALINGE');
    }

    public function testValidPersonWithAccent(): void
    {
        $person = new Person('floriané', 'malingeé', new \DateTimeImmutable('1994-08-15'));
        $this->assertSame($person->getFirstName(), 'FLORIANÉ');
        $this->assertSame($person->getLastName(), 'MALINGEÉ');
    }

    public function testValidPersonWithDash(): void
    {
        $person = new Person('flo-rian', 'mal-inge', new \DateTimeImmutable('1994-08-15'));
        $this->assertSame($person->getFirstName(), 'FLO-RIAN');
        $this->assertSame($person->getLastName(), 'MAL-INGE');
    }

    public function testExceptionInvalidFirstNameWithLengthToShort(): void
    {
        $this->expectException(\Exception::class);
        new Person('fl', 'malinge', new \DateTimeImmutable('1994-08-15'));
    }

    public function testExceptionInvalidFirstNameWithLengthToLong(): void
    {
        $this->expectException(\Exception::class);
        new Person(str_repeat('florian', 15), 'malinge', new \DateTimeImmutable('1994-08-15'));
    }

    public function testExceptionInvalidFirstNameWithSpecialChars(): void
    {
        $this->expectException(\Exception::class);
        new Person('flo_rian', 'malinge', new \DateTimeImmutable('1994-08-15'));
    }

    public function testExceptionInvalidLastNameWithLengthToShort(): void
    {
        $this->expectException(\Exception::class);
        new Person('florian', 'ma', new \DateTimeImmutable('1994-08-15'));
    }

    public function testExceptionInvalidLastNameWithLengthToLong(): void
    {
        $this->expectException(\Exception::class);
        new Person('florian', str_repeat('malinge', 15), new \DateTimeImmutable('1994-08-15'));
    }

    public function testExceptionInvalidLastNameWithSpecialChars(): void
    {
        $this->expectException(\Exception::class);
        new Person('florian', 'mal_inge', new \DateTimeImmutable('1994-08-15'));
    }

    public function testExceptionBirthDateToOld(): void
    {
        $this->expectException(\Exception::class);
        new Person('florian', 'malinge', new \DateTimeImmutable('1900-08-01'));
    }

    public function testExceptionBirthDateToYoung(): void
    {
        $this->expectException(\Exception::class);
        new Person('florian', 'malinge', new \DateTimeImmutable());
    }
}
