<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\PhpVendorCredits\Lib\License\LicenseFinder;

class LicenseFinderTest extends TestCase
{
    public function testNoFiles(): void
    {
        $sut = new LicenseFinder([]);

        $this->assertSame(null, $sut->getLicenseFilename());
    }

    public function testNormal(): void
    {
        $sut = new LicenseFinder(['LICENSE']);

        $this->assertSame('LICENSE', $sut->getLicenseFilename());
    }

    public function testScore(): void
    {
        $sut = new LicenseFinder(['LICENSE', 'LICENSE.md']);

        $this->assertSame('LICENSE', $sut->getLicenseFilename());
    }

    public function testScoreWithUnknownExtension(): void
    {
        $sut = new LicenseFinder(['LICENSE.xxx', 'LICENSE.md']);

        $this->assertSame('LICENSE.md', $sut->getLicenseFilename());
    }
}
