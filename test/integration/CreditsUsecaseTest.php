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

        $this->assertSame(0, count($licenses));
    }
}
