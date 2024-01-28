<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\PhpVendorCredits\Lib\Composer\JsonFile;

class JsonFileTest extends TestCase
{
    public function testNormal(): void
    {

        $json = <<<EOJ
{
}
EOJ;
        $sut = new JsonFile($json);

        $this->assertSame('vendor', $sut->getVendorPath());
    }

    public function testChanged(): void
    {

        $json = <<<EOJ
{
    "config": {
        "vendor-dir": "customized-vendor"
    }
}
EOJ;
        $sut = new JsonFile($json);

        $this->assertSame('customized-vendor', $sut->getVendorPath());
    }
}