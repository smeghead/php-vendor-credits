<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\PhpVendorCredits\Lib\Composer\JsonFile;
use Smeghead\PhpVendorCredits\Lib\Composer\LockFile;

class LockFileTest extends TestCase
{
    public function testEmptyContent(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageMatches('/empty content\./');

        $sut = new LockFile('');
    }

    public function testInvalidJson(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageMatches('/Syntax error/');

        $sut = new LockFile(',{}');
    }

    public function testNormal(): void
    {

        $json = <<<EOJ
{
    "packages": [
        {
            "name": "doctrine/instantiator",
            "version": "1.5.0",
            "license": [
                "MIT"
            ],
            "homepage": "https://www.doctrine-project.org/projects/instantiator.html"
        }
    ]
}
EOJ;
        $sut = new LockFile($json);
        $packages = $sut->getPackages();

        $this->assertSame(1, count($packages));
        $this->assertSame('doctrine/instantiator', $packages[0]->getName());
        $this->assertSame('https://www.doctrine-project.org/projects/instantiator.html', $packages[0]->getUrl());
    }

    public function testNoHomepage(): void
    {

        $json = <<<EOJ
{
    "packages": [
        {
            "name": "doctrine/instantiator",
            "version": "1.5.0",
            "license": [
                "MIT"
            ]
        }
    ]
}
EOJ;
        $sut = new LockFile($json);
        $packages = $sut->getPackages();

        $this->assertSame(1, count($packages));
        $this->assertSame('doctrine/instantiator', $packages[0]->getName());
        $this->assertSame('', $packages[0]->getUrl());
    }
}