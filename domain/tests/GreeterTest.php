<?php

declare(strict_types=1);

namespace Domain\Tests;

use Domain\Company\Model\Company;
use PHPUnit\Framework\TestCase;

class GreeterTest extends TestCase
{
    public function test(): void
    {
        $company = new Company('test', '1');
        $this->assertSame($company->getName(), 'test');
    }
}
