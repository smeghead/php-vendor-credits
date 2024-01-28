<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Smeghead\PhpVendorCredits\Domain\Composer\LockFileFinder;
use Smeghead\PhpVendorCredits\Test;

require_once(__DIR__ . '/../../../../vendor/autoload.php');

class LockFileFinderTest extends TestCase
{
    public function testTest(): void
    {
        $sut = new Test();
        $this->assertNotEmpty($sut);
    }

    public function testDirIsNotExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageMatches('/rootDirectory is not exists./');

        $sut = new LockFileFinder(sprintf('%s/fixtures/not-exists', __DIR__));
        $sut->getPath();
    }
    
    public function testLockFileIsNotExists(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessageMatches('/composer.lock not found./');

        $sut = new LockFileFinder(sprintf('%s/fixtures/no-lockfile', __DIR__));
        $sut->getPath();
    }
}
