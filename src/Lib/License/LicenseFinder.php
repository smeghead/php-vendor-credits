<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Lib\License;

final class LicenseFinder
{
    /** @var array<string> */
    private array $files;

    // copy form https://github.com/Songmu/gocredits/blob/main/licensescore.go
    const regexLicense = <<<EOR
    /^(?:
        ((?:un)?licen[sc]e)| 
        ((?:un)?licen[sc]e\.(?:md|markdown|txt))|
        (copy(?:ing|right)(?:\.[^.]+)?)|
        (licen[sc]e\.[^.]+)
    )$/xi
EOR;

    /**
     * @param array<string> $files
     */
    public function __construct(array $files)
    {
        $this->files = $files;
    }

    public function getLicenseFileName(): ?string
    {
        
        $licenses = [];
        foreach ($this->files as $filename) {
            if (!preg_match(self::regexLicense, $filename, $matches)) {
                continue;
            }
            // copy form https://github.com/Songmu/gocredits/blob/main/licensescore.go
            switch (true) {
                case empty($matches[1]) === false:
                    $licenses['1.0'] = $matches[1];
                    break;
                case empty($matches[2]) === false:
                    $licenses['0.9'] = $matches[2];
                    break;
                case empty($matches[3]) === false:
                    $licenses['0.8'] = $matches[3];
                    break;
                case empty($matches[4]) === false:
                    $licenses['0.7'] = $matches[4];
                    break;
            }
        }
        krsort($licenses);
        return array_shift($licenses);
    }
}
