<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Lib\Usecase;

use Smeghead\PhpVendorCredits\Lib\Composer\JsonFile;
use Smeghead\PhpVendorCredits\Lib\Composer\LockFile;
use Smeghead\PhpVendorCredits\Lib\Composer\LockFileFinder;
use Smeghead\PhpVendorCredits\Lib\License\LicenseFinder;

final class CreditsUsecase {
    private string $rootDirectory;

    public function __construct(string $rootDirectory)
    {
        $this->rootDirectory = $rootDirectory;
    }

    /**
     * @return array<License>
     */
    public function execute(): array
    {
        $lockFileFinder = new LockFileFinder($this->rootDirectory);
        $lockFileContent = file_get_contents($lockFileFinder->getPath());
        if ($lockFileContent === false) {
            throw new \Exception('failed to load lockfile.');
        }
        $lockFile = new LockFile($lockFileContent);
        $jsonFilePath = sprintf('%s/composer.json', $this->rootDirectory);
        $jsonFileContent = file_get_contents($jsonFilePath);
        if ($jsonFileContent === false) {
            throw new \Exception('failed to load jsonfile.');
        }
        $jsonFile = new JsonFile($jsonFileContent);

        $licenses = [];
        foreach ($lockFile->getPackages() as $package) {
            $packageDir = realpath(sprintf('%s/%s/%s', $this->rootDirectory, $jsonFile->getVendorPath(), $package->getName()));
            if ($packageDir === false) {
                throw new \Exception('failed to get package directory.');
            }
            $licenseName = $this->findLicenseName($packageDir);
            $path = null;
            $content = null;
            if (!empty($licenseName)) {
                $path = sprintf('%s/%s', $packageDir, $licenseName);
                $content = file_get_contents($path);
                if ($content === false) {
                    throw new \Exception('failed to get content.');
                }
            }
            $licenses[] = new License(
                $package->getName(),
                $package->getUrl(),
                $path,
                $content
            );
        }
        return $licenses;
    }

    private function findLicenseName(string $directory): ?string
    {
        $entries = glob(sprintf('%s/*', $directory));
        if ($entries === false) {
            return null;
        }
        $files = [];
        foreach ($entries as $entry) {
            if (is_dir($entry)) {
                continue;
            }
            $files[] = basename($entry);
        }
        $licenseFinder = new LicenseFinder($files);
        return $licenseFinder->getLicenseFileName();
    }
}