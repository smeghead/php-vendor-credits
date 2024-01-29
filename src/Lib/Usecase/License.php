<?php

declare(strict_types=1);

namespace Smeghead\PhpVendorCredits\Lib\Usecase;

final class License {
    private string $name;
    private string $url;
    private ?string $path;
    private ?string $content;

    public function __construct(
        string $name,
        string $url,
        ?string $path,
        ?string $content
    )
    {
        $this->name = $name;
        $this->url = $url;
        $this->path = $path;
        $this->content = $content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}