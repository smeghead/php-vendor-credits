<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Lib\Composer;

final class Package {
    private string $name;
    private string $url;

    public function __construct(
        string $name,
        string $url
    )
    {
        $this->name = $name;
        $this->url = $url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}