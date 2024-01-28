<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\PhpVendorCredits\Lib\Composer\LockFileFinder;
use Smeghead\PhpVendorCredits\Test;

class LockFileFinderTest extends TestCase
{
    public function testDirIsNotExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageMatches('/rootDirectory is not exists\./');

        $sut = new LockFileFinder(sprintf('%s/fixtures/not-exists', __DIR__));
        $sut->getPath();
    }

    public function testLockFileIsNotExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageMatches('/composer\.lock not found\./');

        $sut = new LockFileFinder(sprintf('%s/fixtures/no-lockfile', __DIR__));
        $sut->getPath();
    }

    public function testLockFileFound(): void
    {
        $sut = new LockFileFinder(sprintf('%s/fixtures/exists', __DIR__));

        $expected = sprintf('%s/fixtures/exists/composer.lock', __DIR__);
        $this->assertSame($expected, $sut->getPath());
    }
}
