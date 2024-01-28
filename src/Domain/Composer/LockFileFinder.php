<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Domain\Composer;

final class LockFileFinder
{
    private string $rootDirectory;

    public function __construct(string $rootDirectory)
    {
        $this->rootDirectory = $rootDirectory;
    }

    public function getPath(): string
    {
        if (empty($this->rootDirectory)) {
            throw new \Exception('rootDirectory is empty. ' . $this->rootDirectory);
        }
        if (!file_exists($this->rootDirectory)) {
            throw new \Exception('rootDirectory is not exists. ' . $this->rootDirectory);
        }
        return 'fake';
    }
}
