<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\PhpVendorCredits\Lib\Usecase\CreditsUsecase;

class CreditsUsecaseTest extends TestCase
{
    public function testThisProject(): void
    {
        $sut = new CreditsUsecase(__DIR__ . '/../../');

        $licenses = $sut->execute();

        $this->assertSame('psr/container', $licenses[0]->getName());
        $this->assertSame('https://github.com/php-fig/container', $licenses[0]->getUrl());
        $this->assertSame('/usr/src/vendor/psr/container/LICENSE', $licenses[0]->getPath());
        $this->assertMatchesRegularExpression('/Copyright \(c\) 2013-2016 container-interop/', $licenses[0]->getContent());
        $this->assertMatchesRegularExpression('/Copyright \(c\) 2016 PHP Framework Interoperability Group/', $licenses[0]->getContent());
    }
}
